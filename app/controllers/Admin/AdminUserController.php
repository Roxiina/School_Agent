<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;

class AdminUserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();

        // Vérifier que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
        }

        // Récupérer l'utilisateur courant et vérifier le rôle
        $currentUserId = Authenticator::getUserId();
        $user = $this->model->getUser($currentUserId);

        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /home");
            exit;
        }
    }

    // Liste des utilisateurs
    public function index()
    {
        $users = $this->model->getUsers();
        require __DIR__ . '/../../Views/admin/user/index.php';
    }

    // Afficher un utilisateur
    public function show($id)
    {
        $user = $this->model->getUser($id);
        if (!$user) {
            http_response_code(404);
            echo "<h1>Utilisateur introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/user/show.php';
    }

    // Create (formulaire + POST)
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // créer via UserModel
            $this->model->createUser($_POST);
            Authenticator::setFlash("Utilisateur créé avec succès.", "success");
            header('Location: /admin/user');
            exit;
        }

        require __DIR__ . '/../../Views/admin/user/create.php';
    }

    // Edit (formulaire + POST)
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Note: updateUser() ne prend pas en charge le mot de passe dans ton UserModel actuel.
            // Si un mot de passe est fourni dans le formulaire, il sera ignoré (ou tu pourras l'implémenter plus tard).
            $this->model->updateUser($id, $_POST);
            Authenticator::setFlash("Utilisateur mis à jour.", "success");
            header('Location: /admin/user');
            exit;
        }

        $user = $this->model->getUser($id);
        if (!$user) {
            http_response_code(404);
            echo "<h1>Utilisateur introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/user/edit.php';
    }

    // Delete
    public function delete($id)
    {
        $this->model->deleteUser($id);
        Authenticator::setFlash("Utilisateur supprimé.", "info");
        header('Location: /admin/user');
        exit;
    }
}
