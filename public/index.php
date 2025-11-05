<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';


// use SchoolAgent\Controllers\HomeController;
// use SchoolAgent\Controllers\UserController;
use SchoolAgent\Controllers\{
    AuthController
};

use SchoolAgent\Controllers\Front\{
    HomeController,
    AgentsController
};

use SchoolAgent\Controllers\Admin\{
    AdminController,
    AdminUserController,
    AdminLevelController,
    AdminMessageController,
    AdminConversationController,
    AdminSubjectController,
    AdminAgentController,
    AdminUserLogController,
    AdminUserAgentController
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

    case 'agents':
        (new AgentsController())->index();
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

    // -------------------- agent admin ---------------------

    case 'admin/agent':
        (new AdminAgentController())->index();
        break;

    case 'admin/agent/create':
        (new AdminAgentController())->create();
        break;

    case 'admin/agent/show':
        if (isset($_GET['id'])) {
            (new AdminAgentController())->show($_GET['id']);
        }
        break;

    case 'admin/agent/edit':
        if (isset($_GET['id'])) {
            (new AdminAgentController())->edit($_GET['id']);
        } else {
            echo "<h1>Paramètre id manquant</h1>";
        }
        break;

    case 'admin/agent/delete':
        if (isset($_GET['id'])) {
            (new AdminAgentController())->delete($_GET['id']);
        }
        break;

    // -------------------- user_log admin ---------------------
    // Pas de create ou edit car tu m'as dit que les logs sont générés automatiquement
    
    // -------------------- user_log admin ---------------------
    // Pas de create ou edit car les logs sont générés automatiquement

    case 'admin/userlog':
        (new AdminUserLogController())->index();
        break;

    case 'admin/userlog/show':
        if (isset($_GET['id'])) {
            (new AdminUserLogController())->show($_GET['id']);
        }
        break;

    case 'admin/userlog/delete':
        if (isset($_GET['id'])) {
            (new AdminUserLogController())->delete($_GET['id']);
        }
        break;

    // -------------------- useragent admin ---------------------
    case 'admin/useragent':
        (new AdminUserAgentController())->index();
        break;

    case 'admin/useragent/create':
        (new AdminUserAgentController())->create();
        break;

    case 'admin/useragent/edit':
    if (isset($_GET['id_user']) && isset($_GET['id_agent'])) {
        (new AdminUserAgentController())->edit($_GET['id_user'], $_GET['id_agent']);
    } else {
        echo "<h1>Paramètres manquants pour modifier la relation</h1>";
    }
    break;

    case 'admin/useragent/delete':
        if (isset($_GET['id_user'], $_GET['id_agent'])) {
            (new AdminUserAgentController())->delete($_GET['id_user'], $_GET['id_agent']);
        }
        break;
        

    // Page non trouvée
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée, relis ton code !</h1>";
        break;
}
