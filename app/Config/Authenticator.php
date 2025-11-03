<?php
namespace SchoolAgent\Config;

use SchoolAgent\Models\UserModel;

class Authenticator
{
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($userId)
    {
        self::startSession();
        
        // Récupérer les informations de l'utilisateur incluant le rôle
        $userModel = new UserModel();
        $user = $userModel->getUser($userId);
        
        $_SESSION['is_logged'] = true;
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = $user['role'] ?? 'etudiant';
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];

        // ✅ Message flash de connexion
        self::setFlash("Vous êtes maintenant connecté.", "success");
    }

    public static function logout()
    {
        self::startSession();
        session_destroy();

        // ⚠️ On redémarre une session juste pour le message
        session_start();
        self::setFlash("Vous êtes déconnecté.", "info");
    }

    public static function isLogged(): bool
    {
        self::startSession();
        return isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true;
    }

    public static function getUserId()
    {
        self::startSession();
        return $_SESSION['user_id'] ?? null;
    }

    public static function getUserRole()
    {
        self::startSession();
        return $_SESSION['user_role'] ?? null;
    }

    public static function getUserName()
    {
        self::startSession();
        return $_SESSION['user_name'] ?? 'Utilisateur';
    }

    public static function requireLogin()
    {
        if (!self::isLogged()) {
            self::setFlash('Vous devez être connecté pour accéder à cette page.', 'error');
            header('Location: ?page=login');
            exit;
        }
    }

    public static function requireRole($allowedRoles)
    {
        self::requireLogin();
        
        if (!is_array($allowedRoles)) {
            $allowedRoles = [$allowedRoles];
        }
        
        $userRole = self::getUserRole();
        if (!in_array($userRole, $allowedRoles)) {
            self::setFlash('Vous n\'avez pas les droits pour accéder à cette page.', 'error');
            header('Location: ?page=dashboard');
            exit;
        }
    }

    // 🔹 Gestion des messages flash
    public static function setFlash(string $message, string $type = 'info')
    {
        self::startSession();
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
    }

    public static function getFlash(): ?array
    {
        self::startSession();
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']); // le message disparaît après affichage
            return $flash;
        }
        return null;
    }
}
