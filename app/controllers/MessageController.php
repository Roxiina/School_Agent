<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\MessageModel;
use SchoolAgent\Config\Authenticator;

class MessageController {
    private $messageModel;

    public function __construct() {
        $this->messageModel = new MessageModel();
    }

    public function store() {
        Authenticator::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
            $data = [
                'conversation_id' => $_POST['conversation_id'] ?? null,
                'sender_type' => $_POST['sender_type'] ?? 'user',
                'sender_id' => $_POST['sender_id'] ?? $_SESSION['user_id'],
                'content' => $_POST['content']
            ];

            if ($this->messageModel->createMessage($data)) {
                echo json_encode(['success' => true]);
                exit;
            }
        }
        echo json_encode(['success' => false]);
        exit;
    }

    public function index() {
        Authenticator::requireLogin();
        $conversationId = $_GET['conversation_id'] ?? null;
        if (!$conversationId) {
            echo json_encode(['success' => false]);
            exit;
        }
        $messages = $this->messageModel->getMessages($conversationId);
        echo json_encode(['success' => true, 'data' => $messages]);
        exit;
    }

    public function delete($id) {
        Authenticator::requireLogin();
        if ($this->messageModel->deleteMessage($id)) {
            echo json_encode(['success' => true]);
            exit;
        }
        echo json_encode(['success' => false]);
        exit;
    }
}