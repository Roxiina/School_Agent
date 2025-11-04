<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Gestion des assets statiques (CSS, JS, images)
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Servir les fichiers CSS depuis public/css/
if (preg_match('/^css\/(.+\.css)$/', $uri, $matches)) {
    $cssFile = __DIR__ . '/css/' . $matches[1];
    if (file_exists($cssFile)) {
        header('Content-Type: text/css');
        readfile($cssFile);
        exit;
    }
}

// Servir les fichiers JS depuis public/js/
if (preg_match('/^js\/(.+\.js)$/', $uri, $matches)) {
    $jsFile = __DIR__ . '/js/' . $matches[1];
    if (file_exists($jsFile)) {
        header('Content-Type: application/javascript');
        readfile($jsFile);
        exit;
    }
}

// Servir les images depuis app/Views/front/images/
if (preg_match('/^images\/(.+\.(jpg|jpeg|png|gif|svg|webp))$/', $uri, $matches)) {
    $imageFile = __DIR__ . '/../app/Views/front/images/' . $matches[1];
    if (file_exists($imageFile)) {
        $extension = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp'
        ];
        header('Content-Type: ' . ($mimeTypes[$extension] ?? 'application/octet-stream'));
        readfile($imageFile);
        exit;
    }
}

// use SchoolAgent\Controllers\HomeController;
// use SchoolAgent\Controllers\UserController;
use SchoolAgent\Controllers\{
    HomeController,
    UserController,
    AuthController,
    LevelController,
    SubjectController,
    ConversationController,
    MessageController
};
use SchoolAgent\Controllers\Admin\{
    AdminController,
    AdminUserController,
    AdminLevelController,
    AdminMessageController,
    AdminConversationController,
    AdminSubjectController
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

// ---------------------------------------------------------------------------
// ADMINISTRATION DU SITE
// ---------------------------------------------------------------------------

    // http://localhost:8000/admin
    case 'admin':
        (new AdminController())->dashboard();
        break;
    
    // -------------------- user admin ---------------------
    /* admin user list */
    // http://localhost:8000/admin/user
    case 'admin/user':
        (new AdminUserController())->index();
        break;

    /* create */
    case 'admin/user/create':
        (new AdminUserController())->create();
        break;

    /* show */
    case 'admin/user/show':
        if (isset($_GET['id'])) {
            (new AdminUserController())->show($_GET['id']);
        }
        break;

    /* edit */
    case 'admin/user/edit':
        if (isset($_GET['id'])) {
            (new AdminUserController())->edit($_GET['id']);
        } else {
            // allow create/edit without id? here require id
            echo "<h1>Paramètre id manquant</h1>";
        }
        break;

    /* delete */
    case 'admin/user/delete':
        if (isset($_GET['id'])) {
            (new AdminUserController())->delete($_GET['id']);
        }
        break;

    // -------------------- level admin ---------------------
    /* admin level list */
    // http://localhost:8000/admin/level
    case 'admin/level':
        (new AdminLevelController())->index();
        break;

    /* create */
    // http://localhost:8000/admin/level/create
    case 'admin/level/create':
        (new AdminLevelController())->create();
        break;

    /* show */
    // http://localhost:8000/admin/level/show?id=1
    case 'admin/level/show':
        if (isset($_GET['id'])) {
            (new AdminLevelController())->show($_GET['id']);
        }
        break;

    /* edit */
    // http://localhost:8000/admin/level/edit?id=1
    case 'admin/level/edit':
        if (isset($_GET['id'])) {
            (new AdminLevelController())->edit($_GET['id']);
        } else {
            echo "<h1>Paramètre id manquant</h1>";
        }
        break;

    /* delete */
    // http://localhost:8000/admin/level/delete?id=1
    case 'admin/level/delete':
        if (isset($_GET['id'])) {
            (new AdminLevelController())->delete($_GET['id']);
        }
        break;
    
    // -------------------- messages admin ---------------------
    // Liste messages admin
    case 'admin/message':
        (new AdminMessageController())->index();
        break;

    case 'admin/message/create':
        (new AdminMessageController())->create();
        break;

    case 'admin/message/show':
        if (isset($_GET['id'])) {
            (new AdminMessageController())->show($_GET['id']);
        }
        break;

    case 'admin/message/edit':
        if (isset($_GET['id'])) {
            (new AdminMessageController())->edit($_GET['id']);
        } else {
            echo "<h1>Paramètre id manquant</h1>";
        }
        break;

    case 'admin/message/delete':
        if (isset($_GET['id'])) {
            (new AdminMessageController())->delete($_GET['id']);
        }
        break;

    // -------------------- conversation admin ---------------------
    case 'admin/conversation':
        (new AdminConversationController())->index();
        break;

    case 'admin/conversation/create':
        (new AdminConversationController())->create();
        break;

    case 'admin/conversation/show':
        if (isset($_GET['id'])) {
            (new AdminConversationController())->show($_GET['id']);
        }
        break;

    case 'admin/conversation/edit':
        if (isset($_GET['id'])) {
            (new AdminConversationController())->edit($_GET['id']);
        } else {
            echo "<h1>Paramètre id manquant</h1>";
        }
        break;

    case 'admin/conversation/delete':
        if (isset($_GET['id'])) {
            (new AdminConversationController())->delete($_GET['id']);
        }
        break;

    case 'admin/subject':
    (new AdminSubjectController())->index();
    break;

    // -------------------- subject admin ---------------------

    case 'admin/subject/create':
        (new AdminSubjectController())->create();
        break;

    case 'admin/subject/show':
        if (isset($_GET['id'])) {
            (new AdminSubjectController())->show($_GET['id']);
        }
        break;

    case 'admin/subject/edit':
        if (isset($_GET['id'])) {
            (new AdminSubjectController())->edit($_GET['id']);
        }
        break;

    case 'admin/subject/delete':
        if (isset($_GET['id'])) {
            (new AdminSubjectController())->delete($_GET['id']);
        }
        break;

    


        

    // Page non trouvée
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée, relis ton code !</h1>";
        break;
}
