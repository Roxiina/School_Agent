<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Controllers\HomeController;
use SchoolAgent\Controllers\UserController;

// -------------------------------------------------------------
// Récupération propre de la route dans l’URL
// -------------------------------------------------------------
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Si ton projet est dans un sous-dossier, définis-le ici :
$basePath = ''; // ex: '/SCHOOL_AGENT/public'

// Supprime le chemin de base s’il existe
if ($basePath && strpos($uri, ltrim($basePath, '/')) === 0) {
    $uri = substr($uri, strlen(ltrim($basePath, '/')));
}

// 🔹 Priorité au paramètre GET "page"
if (isset($_GET['page']) && $_GET['page'] !== '') {
    $page = $_GET['page'];
} else {
    $page = $uri !== '' ? $uri : 'home';
}

// -------------------------------------------------------------
// Routing via switch-case
// -------------------------------------------------------------
switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    // Liste des utilisateurs
    case 'users':
        $controller = new UserController();
        $controller->index();
        break;

    // Formulaire création utilisateur
    case 'users/create':
        $controller = new UserController();
        $controller->create();
        break;

    
    // Formulaire édition utilisateur
    // http://localhost:8000/users/edit/?id=4
    case 'users/edit':
        if (isset($_GET['id'])) {
            $controller = new UserController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression utilisateur
    // http://localhost:8000/users/delete/?id=4
    case 'users/delete':
        if (isset($_GET['id'])) {
            $controller = new UserController();
            $controller->delete($_GET['id']);
        }
        break;

    // Page non trouvée
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
