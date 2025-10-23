<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Controllers\HomeController;
use SchoolAgent\Controllers\UserController;

// -------------------------------------------------------------
// Étape 1 : Récupération propre de la route dans l’URL ()=> car le serveur integre de php "php -S" ne prend pas en charge .htaccess)
// Le fichier .htaccess ne fonctionne que sous Apache => executer son site via apache avec wamp
// -------------------------------------------------------------
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Si ton projet est dans un sous-dossier, définis-le ici :
$basePath = ''; // ex: '/SCHOOL_AGENT/public'

// Supprime le chemin de base s’il existe
if ($basePath && strpos($uri, ltrim($basePath, '/')) === 0) {
    $uri = substr($uri, strlen(ltrim($basePath, '/')));
}

// 🔹 Si un paramètre GET "page" est présent, il a la priorité
if (isset($_GET['page']) && $_GET['page'] !== '') {
    $page = $_GET['page'];
} else {
    // Sinon on utilise l’URI (ou "home" par défaut)
    $page = $uri !== '' ? $uri : 'home';
}

// -------------------------------------------------------------
// 🔹 Étape 2 : Routing via switch-case (lisible et extensible)
// -------------------------------------------------------------
switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    // http://localhost:8000/?page=users
    // via le .htaccess => http://localhost:8000/users
    case 'users':
        $controller = new UserController();
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}