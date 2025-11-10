<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

header("Content-Type: application/json; charset=utf-8");

$logFile = __DIR__ . "/ask_debug.log";
file_put_contents($logFile, "[" . date("H:i:s") . "] Requête reçue\n", FILE_APPEND);

try {
    // Inclure d'abord l'autoloader
    require_once __DIR__ . "/../../../vendor/autoload.php";

    $input = file_get_contents("php://input");
    file_put_contents($logFile, "[" . date("H:i:s") . "] Input: " . substr($input, 0, 100) . "\n", FILE_APPEND);
    
    $data = json_decode($input, true);

    if (!$data || !isset($data["conversation_id"]) || !isset($data["question"])) {
        throw new Exception("Données manquantes");
    }

    $conversationId = intval($data["conversation_id"]);
    $question = trim($data["question"]);

    file_put_contents($logFile, "[" . date("H:i:s") . "] Conv ID: $conversationId\n", FILE_APPEND);

    // Charger la classe Database
    require_once __DIR__ . "/../../../app/Config/Database.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $pdo = \SchoolAgent\Config\Database::getConnection();
    file_put_contents($logFile, "[" . date("H:i:s") . "] BD connectée\n", FILE_APPEND);

    $stmt = $pdo->prepare("SELECT c.*, a.nom FROM conversation c JOIN agent a ON c.id_agent = a.id_agent WHERE c.id_conversation = ?");
    $stmt->execute([$conversationId]);
    $conversation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$conversation) {
        throw new Exception("Conversation $conversationId non trouvée");
    }

    file_put_contents($logFile, "[" . date("H:i:s") . "] Conversation trouvée: " . $conversation["nom"] . "\n", FILE_APPEND);

    // Récupérer les messages précédents pour le contexte
    $stmt = $pdo->prepare("SELECT question, reponse FROM message WHERE id_conversation = ? ORDER BY id_message ASC LIMIT 10");
    $stmt->execute([$conversationId]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    file_put_contents($logFile, "[" . date("H:i:s") . "] Messages précédents: " . count($messages) . "\n", FILE_APPEND);

    // Construire l'historique pour Groq API
    $conversationHistory = [];
    foreach ($messages as $msg) {
        if (!empty($msg["question"])) {
            $conversationHistory[] = [
                "role" => "user",
                "content" => $msg["question"]
            ];
        }
        if (!empty($msg["reponse"])) {
            $conversationHistory[] = [
                "role" => "assistant",
                "content" => $msg["reponse"]
            ];
        }
    }

    // Ajouter le nouveau message
    $conversationHistory[] = [
        "role" => "user",
        "content" => $question
    ];

    file_put_contents($logFile, "[" . date("H:i:s") . "] Appel Groq API\n", FILE_APPEND);

    // Charger la configuration
    $config = include __DIR__ . "/../../../config.php";
    $apiKey = $config['GROQ_API_KEY'] ?? null;
    
    if (!$apiKey) {
        throw new Exception("Clé API Groq non configurée");
    }
    
    $model = $config['AI_DEFAULT_MODEL'] ?? "mixtral-8x7b-32768";

    // Préparer la requête pour Groq
    $requestBody = json_encode([
        "model" => $model,
        "messages" => $conversationHistory,
        "temperature" => 0.7,
        "max_tokens" => 1000
    ]);

    // Appel cURL vers l'API Groq
    $ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
    
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . $apiKey,
            "Content-Type: application/json"
        ],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $requestBody,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);

    $response = curl_exec($ch);
    $curlError = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    file_put_contents($logFile, "[" . date("H:i:s") . "] Réponse Groq (HTTP $httpCode): " . substr($response, 0, 200) . "\n", FILE_APPEND);

    if ($curlError) {
        throw new Exception("Erreur cURL: " . $curlError);
    }

    $result = json_decode($response, true);

    if (!$result || !isset($result["choices"][0]["message"]["content"])) {
        throw new Exception("Réponse API invalide: " . substr($response, 0, 200));
    }

    $aiResponse = $result["choices"][0]["message"]["content"];

    file_put_contents($logFile, "[" . date("H:i:s") . "] IA Réponse: " . substr($aiResponse, 0, 100) . "\n", FILE_APPEND);
    
    file_put_contents($logFile, "[" . date("H:i:s") . "] IA Réponse: " . substr($aiResponse, 0, 100) . "\n", FILE_APPEND);
    
    // Sauvegarder le message
    $stmt = $pdo->prepare("INSERT INTO message (id_conversation, question, reponse) VALUES (?, ?, ?)");
    $stmt->execute([$conversationId, $question, $aiResponse]);

    file_put_contents($logFile, "[" . date("H:i:s") . "] Message sauvegardé\n", FILE_APPEND);

    echo json_encode([
        "success" => true,
        "response" => $aiResponse
    ]);

} catch (Exception $e) {
    file_put_contents($logFile, "[" . date("H:i:s") . "] ERREUR: " . $e->getMessage() . "\n", FILE_APPEND);
    
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>

