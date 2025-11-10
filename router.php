<?php
/**
 * Router pour le serveur PHP intégré
 * Utilisation: php -S localhost:8080 router.php -t public
 */

$requestUri = $_SERVER['REQUEST_URI'];

// Servir les fichiers statiques
if (preg_match('/\.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/i', $requestUri)) {
    return false;
}

// Permettre l'accès direct aux fichiers dans /api/
if (strpos($requestUri, '/api/') === 0) {
    $filePath = __DIR__ . '/public' . $requestUri;
    if (file_exists($filePath) && is_file($filePath)) {
        return false;
    }
}

// Rediriger tout le reste vers index.php
require __DIR__ . '/public/index.php';
?>
