<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\MessageModel;
use SchoolAgent\Config\Authenticator;
use Exception;
use PDOException;

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

    public function create() {
        Authenticator::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conversationId = $_POST['conversation_id'] ?? null;
            $question = $_POST['question'] ?? null;
            
            if ($conversationId && $question) {
                $data = [
                    'question' => $question,
                    'reponse' => 'En attente de réponse...',
                    'id_conversation' => $conversationId
                ];
                $result = $this->messageModel->createMessage($data);

                // Retourner la réponse JSON avec l'id inséré si possible
                header('Content-Type: application/json');
                if ($result !== false) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Message envoyé',
                        'reponse' => $data['reponse'],
                        'message_id' => $result
                    ]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la sauvegarde']);
                }
                exit;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Données manquantes']);
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

    public function update() {
        Authenticator::requireLogin();
        header('Content-Type: application/json');
        
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $messageId = $_POST['message_id'] ?? null;
                $question = $_POST['question'] ?? null;
                
                if (!$messageId || !$question) {
                    echo json_encode(['success' => false, 'error' => 'Données manquantes']);
                    exit;
                }
                
                if ($this->messageModel->updateMessageQuestion($messageId, $question)) {
                    echo json_encode(['success' => true, 'message' => 'Message modifié']);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'error' => 'Aucun message modifié']);
                    exit;
                }
            }
        } catch (Exception $e) {
            error_log('MessageController::update() error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erreur serveur: ' . $e->getMessage()]);
            exit;
        }
        
        echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
        exit;
    }

    public function delete() {
        Authenticator::requireLogin();
        header('Content-Type: application/json');
        
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $messageId = $_POST['message_id'] ?? null;
                
                if (!$messageId) {
                    echo json_encode(['success' => false, 'error' => 'ID du message manquant']);
                    exit;
                }
                
                if ($this->messageModel->deleteMessage($messageId)) {
                    echo json_encode(['success' => true, 'message' => 'Message supprimé']);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'error' => 'Aucun message supprimé']);
                    exit;
                }
            }
        } catch (Exception $e) {
            error_log('MessageController::delete() error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erreur serveur: ' . $e->getMessage()]);
            exit;
        }
        
        echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
        exit;
    }
}
