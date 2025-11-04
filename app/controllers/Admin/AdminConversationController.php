<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\UserModel;

class AdminConversationController
{
    private $model;

    public function __construct()
    {
        $this->model = new ConversationModel();

        // Vérification connexion
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
            
        }

        // Vérification rôle admin
        $currentUserId = Authenticator::getUserId();
        $userModel = new UserModel();
        $user = $userModel->getUser($currentUserId);

        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /home");
            exit;
        }
    }

    // Liste des conversations
    public function index()
    {
        $conversations = $this->model->getConversations();
        require __DIR__ . '/../../Views/admin/conversation/index.php';
    }

    // Afficher une conversation
    public function show($id)
    {
        $conversation = $this->model->getConversation($id);
        if (!$conversation) {
            http_response_code(404);
            echo "<h1>Conversation introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/conversation/show.php';
    }

    // Création conversation
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createConversation($_POST);
            Authenticator::setFlash("Conversation créée avec succès.", "success");
            header("Location: /admin/conversation");
            exit;
        }
        require __DIR__ . '/../../Views/admin/conversation/create.php';
    }

    // Édition conversation
    public function edit($id)
    {
        $conversation = $this->model->getConversation($id);
        if (!$conversation) {
            http_response_code(404);
            echo "<h1>Conversation introuvable</h1>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateConversation($id, $_POST);
            Authenticator::setFlash("Conversation mise à jour.", "success");
            header("Location: /admin/conversation");
            exit;
        }

        require __DIR__ . '/../../Views/admin/conversation/edit.php';
    }

    // Suppression conversation
    public function delete($id)
    {
        $this->model->deleteConversation($id);
        Authenticator::setFlash("Conversation supprimée.", "info");
        header("Location: /admin/conversation");
        exit;
    }
}
