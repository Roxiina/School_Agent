<?php
/**
 * Contrôleur pour les pages RGPD et légales
 */

namespace SchoolAgent\Controllers;

class PrivacyController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/privacy/index.php';
    }

    public function terms()
    {
        require_once __DIR__ . '/../Views/privacy/terms.php';
    }

    public function cookies()
    {
        require_once __DIR__ . '/../Views/privacy/cookies.php';
    }

    public function contact()
    {
        require_once __DIR__ . '/../Views/privacy/contact.php';
    }

    public function dataRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleDataRequest();
        } else {
            require_once __DIR__ . '/../Views/privacy/data_request.php';
        }
    }

    private function handleDataRequest()
    {
        // Traiter les demandes de données personnelles
        $requestType = $_POST['request_type'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        // Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse email invalide";
            require_once __DIR__ . '/../Views/privacy/data_request.php';
            return;
        }

        // Enregistrer la demande (à implémenter selon vos besoins)
        $this->logDataRequest($requestType, $email, $message);

        // Redirection avec message de succès
        header('Location: ?page=privacy&action=data_request&success=1');
        exit;
    }

    private function logDataRequest($type, $email, $message)
    {
        // Log de la demande RGPD
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'email' => $email,
            'message' => $message,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];

        // Enregistrer dans un fichier ou base de données
        $logFile = __DIR__ . '/../../logs/rgpd_requests.log';
        if (!is_dir(dirname($logFile))) {
            mkdir(dirname($logFile), 0755, true);
        }
        
        file_put_contents($logFile, json_encode($logEntry) . "\n", FILE_APPEND | LOCK_EX);
    }
}
?>