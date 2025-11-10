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
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];

        // Récupérer les agents liés à l'utilisateur
        $agentsData = $this->agentModel->getAgentsByUser($userId);

        // Transformer les données pour la vue
        $agents = array_map(function($agent) {
            return [
                'id' => $agent['id_agent'],
                'name' => $agent['nom'],
                'description' => $agent['description'] ?? 'Aucune description disponible',
                'avatar' => $agent['avatar'] ?? null,
                'status' => 'active', // Par défaut, tous les agents sont actifs
                'tags' => '', // Pas de tags dans la base de données pour le moment
                'temperature' => $agent['temperature'] ?? 1.0,
                'system_prompt' => $agent['system_prompt'] ?? '',
                'model' => $agent['model'] ?? 'llama-3.1-8b-instant',
                'max_completion_tokens' => $agent['max_completion_tokens'] ?? 512
            ];
        }, $agentsData);

        // La vue gérera l'affichage si $agents est vide
        require __DIR__ . '/../../Views/front/ia/ia.php';
    }

    public function showConversations($agentId)
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];

        $conversationModel = new \SchoolAgent\Models\ConversationModel();

        // Sécurité : Vérifier que l'agent est bien accessible par l'utilisateur
        $userAgents = $this->agentModel->getAgentsByUser($userId);
        $allowedAgentIds = array_column($userAgents, 'id_agent');
        if (!in_array($agentId, $allowedAgentIds)) {
            die("❌ Accès non autorisé à cet agent.");
        }

        $agent = $this->agentModel->getAgent($agentId);
        $conversations = $conversationModel->getConversationsByUserAndAgent($userId, $agentId);

        // Le chemin de la vue est mis à jour selon votre demande
        require __DIR__ . '/../../Views/front/ia/conversation/index.php';
    }

    public function showChat($conversationId = null, $agentIdForNew = null)
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $conversationModel = new \SchoolAgent\Models\ConversationModel();
        $messageModel = new \SchoolAgent\Models\MessageModel();
        
        $isNew = ($conversationId === null);
        $conversation = null;
        $agent = null;
        $messages = [];

        if ($isNew) {
            // C'est une nouvelle conversation
            $agent = $this->agentModel->getAgent($agentIdForNew);
            if (!$agent) die("❌ Agent non trouvé.");
            // On prépare une conversation "virtuelle" pour le titre de la page
            $conversation = ['titre' => 'Nouvelle conversation'];

        } else {
            // C'est une conversation existante
            $conversation = $conversationModel->getConversation($conversationId);
            if (!$conversation || $conversation['id_user'] != $userId) {
                die("❌ Accès non autorisé à cette conversation.");
            }
            $agent = $this->agentModel->getAgent($conversation['id_agent']);
            $messages = $messageModel->getMessagesByConversationId($conversationId);
        }

        // Traitement de l'envoi d'un message (pour nouveau ou existant)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
            $prompt = $_POST['prompt'];

            if ($isNew) {
                // Logique pour le PREMIER message : créer la conversation + le message
                $convData = [
                    'titre' => 'Conversation du ' . date('d-m-Y H:i'),
                    'date_creation' => date('Y-m-d H:i:s'),
                    'id_agent' => $agentIdForNew,
                    'id_user' => $userId
                ];
                $newConversationId = $conversationModel->createConversation($convData);
                $conversationId = $newConversationId; // On a maintenant un ID
            }
            
            $responseAI = $this->askAI($prompt, $agent);
            $messageData = [
                'question' => $prompt,
                'reponse' => $responseAI,
                'id_conversation' => $conversationId
            ];
            $messageModel->createMessage($messageData);

            // Rediriger vers la page de chat avec l'ID permanent
            header('Location: /ia/chat?id=' . $conversationId);
            exit;
        }

        require __DIR__ . '/../../Views/front/ia/conversation/show.php';
    }

    public function deleteConversation()
    {
        session_start();

        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $conversationId = $_POST['conversation_id'] ?? null;
        $agentId = $_POST['agent_id'] ?? null;

        if (!$conversationId || !$agentId) {
            // Rediriger si les IDs sont manquants
            header('Location: /ia');
            exit;
        }

        $conversationModel = new \SchoolAgent\Models\ConversationModel();

        // Sécurité : Vérifier que la conversation à supprimer appartient bien à l'utilisateur
        $conversation = $conversationModel->getConversation($conversationId);
        if (!$conversation || $conversation['id_user'] != $userId) {
            die("❌ Action non autorisée.");
        }

        // Supprimer la conversation
        $conversationModel->deleteConversation($conversationId);

        // Rediriger vers la page de l'historique
        header('Location: /ia/conversations?id=' . $agentId);
        exit;
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
