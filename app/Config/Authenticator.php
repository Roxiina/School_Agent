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
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $userId;
        $_SESSION['is_logged'] = true; // Pour compatibilité

        // Récupérer les infos utilisateur depuis la BD
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT id_user, nom, email FROM utilisateur WHERE id_user = ?");
            $stmt->execute([$userId]);
            
            if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $_SESSION['user_name'] = $row['nom'];
                $_SESSION['user_email'] = $row['email'];
            }
        } catch (\Exception $e) {
            // En cas d'erreur, on continue quand même la connexion
            error_log("Erreur lors du fetch utilisateur: " . $e->getMessage());
        }

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

    public static function requireLogin()
    {
        self::startSession();
        if (!self::isLogged()) {
            header('Location: ?page=login');
            exit;
        }
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
