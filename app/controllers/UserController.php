<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\UserModel;
use SchoolAgent\Config\Authenticator;

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    // Liste tous les utilisateurs
    public function index()
    {
        // Seuls les professeurs et admins peuvent voir la liste des utilisateurs
        Authenticator::requireRole(['professeur', 'admin']);
        $users = $this->model->getUsers();
        require __DIR__ . '/../Views/user/index.php';
    }

    // Afficher le profil d'un utilisateur
    public function show($id)
    {
        $user = $this->model->getUser($id);

        if (!$user) {
            http_response_code(404);
            echo "<h1>Utilisateur introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/user/show.php';
    }

    // Profil de l'utilisateur connecté
    public function profile()
    {
        Authenticator::requireLogin();
        $userId = Authenticator::getUserId();
        $user = $this->model->getUser($userId);
        
        if (!$user) {
            Authenticator::setFlash('Utilisateur introuvable.', 'error');
            header('Location: ?page=dashboard');
            exit;
        }
        
        require __DIR__ . '/../Views/user/profile.php';
    }

    // Formulaire création utilisateur + traitement POST
    public function create()
    {
        // Seuls les admins peuvent créer des utilisateurs
        Authenticator::requireRole(['admin']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de l'utilisateur directement depuis le formulaire
            $this->model->createUser($_POST);
            header('Location: ?page=user');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/user/create.php';
    }

    // Formulaire édition utilisateur + traitement POST
    
    public function edit($id)
    {
        // Vérifier les droits d'accès
        $currentUserId = Authenticator::getUserId();
        $currentUserRole = Authenticator::getUserRole();
        
        // Un utilisateur peut éditer son propre profil
        // Les professeurs et admins peuvent éditer d'autres profils
        if ($id != $currentUserId && !in_array($currentUserRole, ['professeur', 'admin'])) {
            Authenticator::setFlash('Vous ne pouvez pas modifier ce profil.', 'error');
            header('Location: ?page=dashboard');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateUser($id, $_POST);
            header('Location: ?page=user');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $user = $this->model->getUser($id);
        require __DIR__ . '/../Views/user/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        // Seuls les admins peuvent supprimer des utilisateurs
        Authenticator::requireRole(['admin']);
        
        $this->model->deleteUser($id);
        header('Location: ?page=user');
        exit;
    }
}
