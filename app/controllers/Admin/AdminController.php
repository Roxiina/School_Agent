<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;

class AdminController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        // Vérifie que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
        }

        // Récupère les informations complètes de l'utilisateur
        $user = $this->userModel->getUser(Authenticator::getUserId());

        // Vérifie le rôle admin
        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /");
            exit;
        }
    }

    public function dashboard()
    {
        include __DIR__ . '/front_admin/pages/dashboard.php';
    }
}
