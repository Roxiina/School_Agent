<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\MessageModel;

class AdminMessageController
{
    private $model;

    public function __construct()
    {
        $this->model = new MessageModel();

        // Vérification de la connexion
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
        }

        // Vérification du rôle admin
        $currentUserId = Authenticator::getUserId();
        // ici, on suppose que tu as un UserModel pour récupérer le rôle
        $userModel = new \SchoolAgent\Models\UserModel();
        $user = $userModel->getUser($currentUserId);

        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /home");
            exit;
        }
    }

    // Liste des messages
    public function index()
    {
        $messages = $this->model->getMessages();
        require __DIR__ . '/../../Views/admin/message/index.php';
    }

    // Afficher un message
    public function show($id)
    {
        $message = $this->model->getMessage($id);
        if (!$message) {
            http_response_code(404);
            echo "<h1>Message introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/message/show.php';
    }

    // Création message
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createMessage($_POST);
            Authenticator::setFlash("Message créé avec succès.", "success");
            header("Location: /admin/message");
            exit;
        }

        require __DIR__ . '/../../Views/admin/message/create.php';
    }

    // Édition message
    public function edit($id)
    {
        $message = $this->model->getMessage($id);
        if (!$message) {
            http_response_code(404);
            echo "<h1>Message introuvable</h1>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateMessage($id, $_POST);
            Authenticator::setFlash("Message mis à jour.", "success");
            header("Location: /admin/message");
            exit;
        }

        require __DIR__ . '/../../Views/admin/message/edit.php';
    }

    // Suppression message
    public function delete($id)
    {
        $this->model->deleteMessage($id);
        Authenticator::setFlash("Message supprimé.", "info");
        header("Location: /admin/message");
        exit;
    }
}
