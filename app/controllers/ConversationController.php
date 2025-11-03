<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\MessageModel;
use SchoolAgent\Config\Authenticator;

class ConversationController {
    private $conversationModel;
    private $messageModel;

    public function __construct() {
        $this->conversationModel = new ConversationModel();
        $this->messageModel = new MessageModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $userId = $_SESSION['user_id'] ?? null;
        $conversations = $this->conversationModel->getConversations($userId);
        
        // Préparer les données pour la vue
        $conversationsData = [];
        foreach ($conversations as $conv) {
            $messages = $this->messageModel->getMessages($conv['id_conversation']);
            $conversationsData[] = [
                'id' => $conv['id_conversation'],
                'titre' => $conv['titre'],
                'agent_nom' => $conv['agent_nom'],
                'agent_id' => $conv['id_agent'],
                'messages' => $messages,
                'date_creation' => $conv['date_creation']
            ];
        }
        
        require __DIR__ . '/../Views/conversation/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $conversation = $this->conversationModel->getConversation($id);
        if (!$conversation) {
            http_response_code(404);
            echo "<h1>Conversation introuvable</h1>";
            exit;
        }
        $messages = $this->messageModel->getMessages($id);
        require __DIR__ . '/../Views/conversation/show.php';
    }

    public function create() {
        Authenticator::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $agentId = $_POST['agent_id'] ?? 1;
            $title = $_POST['title'] ?? 'Nouvelle conversation';
            
            // Valider les données
            if (empty($title)) {
                $_SESSION['error'] = 'Le titre ne peut pas être vide';
            } else {
                $data = [
                    'titre' => trim($title),
                    'date_creation' => date('Y-m-d H:i:s'),
                    'id_agent' => (int)$agentId,
                    'id_user' => (int)$userId
                ];
                
                if ($this->conversationModel->createConversation($data)) {
                    $_SESSION['success'] = 'Conversation créée avec succès !';
                    header('Location: ?page=conversation');
                    exit;
                } else {
                    $_SESSION['error'] = 'Erreur lors de la création de la conversation';
                }
            }
        }
        
        require __DIR__ . '/../Views/conversation/create.php';
    }

    public function edit($id) {
        Authenticator::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['title' => $_POST['title'] ?? ''];
            if ($this->conversationModel->updateConversation($id, $data)) {
                $_SESSION['success'] = 'Conversation mise à jour.';
                header('Location: ?page=conversation&action=show&id=' . $id);
                exit;
            }
        }
        $conversation = $this->conversationModel->getConversation($id);
        require __DIR__ . '/../Views/conversation/edit.php';
    }

    public function delete($id) {
        Authenticator::requireLogin();
        if ($this->conversationModel->deleteConversation($id)) {
            $_SESSION['success'] = 'Conversation supprimée.';
        }
        header('Location: ?page=conversation');
        exit;
    }
}