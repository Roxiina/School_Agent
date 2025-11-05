<?php
namespace SchoolAgent\Controllers\front;

use SchoolAgent\Models\AgentModel;

class IaController
{
    private $apiKey;
    private $agentModel;

    public function __construct()
    {
        // Charger la clé API depuis config.php
        $config = require __DIR__ . '/../../../config.php';
        $this->apiKey = $config['GROQ_API_KEY'];

        // Charger le model Agent
        $this->agentModel = new AgentModel();
    }

    public function index()
    {
        session_start(); // Assure que la session est active

        // Vérifier qu’un utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            die("❌ Accès refusé : utilisateur non connecté.");
        }

        $userId = $_SESSION['user_id'];

        // Récupérer les agents liés à l'utilisateur
        $agents = $this->agentModel->getAgentsByUser($userId);

        // Aucun agent assigné → bloquer
        if (empty($agents)) {
            die("❌ Aucun agent disponible pour votre compte.");
        }

        $responseAI = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
            $prompt = $_POST['prompt'];

            // Agent choisi
            $agentId = $_POST['agent_id'] ?? null;
            $agent = $this->agentModel->getAgent($agentId);

            // Vérifier que l’agent appartient bien à l’utilisateur
            $allowedAgentIds = array_column($agents, 'id_agent');
            if (!$agent || !in_array($agentId, $allowedAgentIds)) {
                $responseAI = "❌ Agent introuvable ou non autorisé.";
            } else {
                $responseAI = $this->askAI($prompt, $agent);
            }
        }

        require __DIR__ . '/../../Views/front/ia.php';
    }

    private function askAI($prompt, $agent)
    {
        $model = $agent['model'] ?? 'llama-3.1-8b-instant';
        $temperature = $agent['temperature'] ?? 1;
        $maxTokens = $agent['max_completion_tokens'] ?? 512;

        $payload = [
            "messages" => [
                ["role" => "user", "content" => $prompt]
            ],
            "model" => $model,
            "temperature" => (float)$temperature,
            "max_completion_tokens" => (int)$maxTokens
        ];

        $ch = curl_init("https://api.groq.com/openai/v1/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $result = curl_exec($ch);

        if ($result === false) {
            return "❌ Erreur CURL : " . curl_error($ch);
        }

        $json = json_decode($result, true);
        curl_close($ch);

        if (isset($json['error'])) {
            return "❌ Erreur API : " . $json['error']['message'];
        }

        return $json['choices'][0]['message']['content'] ?? "Erreur API 🚨";
    }
}
