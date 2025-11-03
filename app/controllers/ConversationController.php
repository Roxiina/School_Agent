<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\MessageModel;
use SchoolAgent\Models\AgentModel;
use SchoolAgent\Config\Authenticator;

class ConversationController
{
    private $model;
    private $messageModel;
    private $agentModel;

    public function __construct()
    {
        $this->model = new ConversationModel();
        $this->messageModel = new MessageModel();
        $this->agentModel = new AgentModel();
    }

    // Liste toutes les conversations
    public function index()
    {
        $conversations = $this->model->getConversations();
        require __DIR__ . '/../Views/conversation/index.php';
    }

    // Afficher le profil d’un conversation
    public function show($id)
    {
        $conversation = $this->model->getConversation($id);

        if (!$conversation) {
            http_response_code(404);
            echo "<h1>Conversation introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/conversation/show.php';
    }

    // Formulaire création conversation + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier que l'utilisateur est connecté
            Authenticator::requireLogin();

            // Validation des données
            $titre = trim($_POST['titre'] ?? '');
            $id_agent = $_POST['id_agent'] ?? null;

            if (!$titre || !$id_agent) {
                Authenticator::setFlash('error', 'Le titre et l\'agent sont requis');
                header('Location: ?page=conversation/create');
                exit;
            }

            // Créer la conversation
            $data = [
                'titre' => $titre,
                'date_creation' => date('Y-m-d H:i:s'),
                'id_agent' => $id_agent,
                'id_user' => Authenticator::getUserId()
            ];

            $this->model->createConversation($data);

            // Rediriger vers le chat
            $conversations = $this->model->getConversationsByUser(Authenticator::getUserId());
            $lastConversation = end($conversations);
            
            Authenticator::setFlash('success', 'Conversation créée avec succès !');
            header('Location: ?page=conversation/chat&id=' . $lastConversation['id_conversation']);
            exit;
        }

        // Sinon, on affiche le formulaire avec les agents disponibles
        $agentModel = new AgentModel();
        $agents = $agentModel->getAgents();
        require __DIR__ . '/../Views/conversation/create.php';
    }

    // Formulaire édition conversation + traitement POST
    
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateConversation($id, $_POST);
            header('Location: /conversation');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $conversation = $this->model->getConversation($id);
        require __DIR__ . '/../Views/conversation/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        $this->model->deleteConversation($id);
        header('Location: /conversation');
        exit;
    }

    // Interface de chat pour une conversation
    public function chat($conversationId = null)
    {
        // Vérifier que l'utilisateur est connecté
        Authenticator::requireLogin();

        // Si pas d'ID de conversation en GET, afficher la liste des conversations de l'utilisateur
        if ($conversationId === null && isset($_GET['id'])) {
            $conversationId = $_GET['id'];
        }

        // Récupérer la conversation
        if ($conversationId) {
            $conversation = $this->model->getConversation($conversationId);
            if (!$conversation) {
                http_response_code(404);
                echo "<h1>Conversation introuvable</h1>";
                exit;
            }

            // Vérifier que l'utilisateur a accès à cette conversation
            if ($conversation['id_user'] != Authenticator::getUserId()) {
                http_response_code(403);
                echo "<h1>Accès refusé</h1>";
                exit;
            }

            // Récupérer les messages
            $messages = $this->messageModel->getMessagesByConversation($conversationId);
            
            // Récupérer l'agent
            $agent = $this->agentModel->getAgent($conversation['id_agent']);
        } else {
            $messages = [];
            $conversation = null;
            $agent = null;
        }

        require __DIR__ . '/../Views/conversation/chat.php';
    }

    // Envoyer un message via AJAX
    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            echo json_encode(['error' => 'Méthode non autorisée']);
            exit;
        }

        // Vérifier que l'utilisateur est connecté
        Authenticator::requireLogin();

        // Récupérer les données JSON
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['conversation_id']) || !isset($data['question'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Données manquantes']);
            exit;
        }

        // Récupérer la conversation
        $conversation = $this->model->getConversation($data['conversation_id']);
        if (!$conversation) {
            http_response_code(404);
            echo json_encode(['error' => 'Conversation introuvable']);
            exit;
        }

        // Vérifier que l'utilisateur a accès à cette conversation
        if ($conversation['id_user'] != Authenticator::getUserId()) {
            http_response_code(403);
            echo json_encode(['error' => 'Accès refusé']);
            exit;
        }

        // Pour maintenant, on fait une réponse simulée. Plus tard, on intégrera OpenAI
        $question = htmlspecialchars(trim($data['question']));
        $reponse = "Je suis une réponse simulée. Intégration OpenAI en cours...";

        // Sauvegarder le message
        $messageData = [
            'question' => $question,
            'reponse' => $reponse,
            'id_conversation' => $data['conversation_id']
        ];
        $this->messageModel->createMessage($messageData);

        // Retourner la réponse
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => [
                'question' => $question,
                'reponse' => $reponse
            ]
        ]);
        exit;
    }

    /**
     * Supprimer TOUTES les conversations de l'utilisateur
     */
    public function deleteAll()
    {
        Authenticator::requireLogin();
        $userId = Authenticator::getUserId();

        try {
            // Récupérer toutes les conversations de l'utilisateur
            $conversations = $this->model->getConversationsByUser($userId);

            // Supprimer chaque conversation
            foreach ($conversations as $conv) {
                $this->model->deleteConversation($conv['id']);
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Toutes les conversations supprimées']);
            exit;
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    /**
     * Exporter les conversations en JSON
     */
    public function export()
    {
        Authenticator::requireLogin();
        $userId = Authenticator::getUserId();

        try {
            $conversations = $this->model->getConversationsByUser($userId);

            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="conversations_' . time() . '.json"');
            echo json_encode($conversations, JSON_PRETTY_PRINT);
            exit;
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }
}
