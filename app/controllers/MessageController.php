<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\MessageModel;

class MessageController
{
    private $model;

    public function __construct()
    {
        $this->model = new MessageModel();
    }

    // Liste tous les messages
    public function index()
    {
        $messages = $this->model->getMessages();
        require __DIR__ . '/../Views/message/index.php';
    }

    // Afficher le message
    public function show($id)
    {
        $message = $this->model->getMessage($id);

        if (!$message) {
            http_response_code(404);
            echo "<h1>Message introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/message/show.php';
    }

    // Formulaire création message + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de message directement depuis le formulaire
            $this->model->createMessage($_POST);
            header('Location: /message');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/message/create.php';
    }

    // Formulaire édition message + traitement POST
    
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateMessage($id, $_POST);
            header('Location: /message');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données du message
        $message = $this->model->getMessage($id);
        require __DIR__ . '/../Views/message/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        $this->model->deleteMessage($id);
        header('Location: /message');
        exit;
    }

    // Enregistrer un message en AJAX (JSON response)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        $conversationId = $_POST['conversation_id'] ?? null;
        $messageText = $_POST['message'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        if (!$conversationId || !$messageText || !$userId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing fields']);
            exit;
        }

        try {
            $data = [
                'conversation_id' => $conversationId,
                'user_id' => $userId,
                'message' => $messageText
            ];

            $result = $this->model->createMessage($data);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Message saved', 'id' => $result]);
            exit;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }
}