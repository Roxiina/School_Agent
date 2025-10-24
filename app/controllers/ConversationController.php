<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;

class ConversationController
{
    private $model;

    public function __construct()
    {
        $this->model = new ConversationModel();
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
            // Création de conversation directement depuis le formulaire
            $this->model->createConversation($_POST);
            header('Location: /conversation');
            exit;
        }

        // Sinon, on affiche le formulaire
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
}
