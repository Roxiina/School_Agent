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
}