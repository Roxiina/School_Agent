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
            $data = [
                'user_id' => $_SESSION['user_id'],
                'agent_id' => $_POST['agent_id'] ?? 1,
                'subject_id' => $_POST['subject_id'] ?? 1,
                'title' => $_POST['title'] ?? 'Nouvelle conversation'
            ];
            if ($this->conversationModel->createConversation($data)) {
                $_SESSION['success'] = 'Conversation créée.';
                header('Location: ?page=conversation');
                exit;
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