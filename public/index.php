<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// use SchoolAgent\Controllers\HomeController;
// use SchoolAgent\Controllers\UserController;
use SchoolAgent\Controllers\{
    HomeController,
    UserController,
    AuthController
};

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

// Priorité au paramètre GET "page"
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

    case 'login':
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;
    
    
        // Liste des utilisateurs
    case 'user':
        $controller = new UserController();
        $controller->index();
        break;

    // Afficher le profil utilisateur
    // Exemple : http://localhost:8000/user/show?id=4
    case 'user/show':
    if (isset($_GET['id'])) {
        $controller = new UserController();
        $controller->show($_GET['id']);
    } else {
        echo "<h1>Erreur : ID manquant</h1>";
    }
    break;

    // Formulaire création utilisateur
    case 'user/create':
        $controller = new UserController();
        $controller->create();
        break;
    
    // Formulaire édition utilisateur
    // http://localhost:8000/user/edit/?id=4
    case 'user/edit':
        if (isset($_GET['id'])) {
            $controller = new UserController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression utilisateur
    // http://localhost:8000/user/delete/?id=4
    case 'user/delete':
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
