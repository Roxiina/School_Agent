<?php
namespace SchoolAgent\Config;

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
        $_SESSION['is_logged'] = true;
        $_SESSION['user_id'] = $userId;

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
