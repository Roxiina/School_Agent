<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

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
use SchoolAgent\Config\Authenticator;
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

// Gérer le paramètre "action" pour les pages avec sous-actions
if (isset($_GET['action']) && $_GET['action'] !== '') {
    $page = $page . '/' . $_GET['action'];
}

// Couper le paramètre page pour éviter les doublons (ex: 'conversation/create/create')
$page = trim($page, '/');

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

    case 'user':
        (new UserController())->profile();
        break;

    case 'user/edit':
        (new UserController())->edit();
        break;

    case 'conversation':
        (new ConversationController())->index();
        break;

    case 'conversation/create':
        (new ConversationController())->create();
        break;

    case 'conversation/show':
        if (isset($_GET['id'])) {
            (new ConversationController())->show($_GET['id']);
        }
        break;

    case 'conversation/update':
        if (isset($_GET['id'])) {
            Authenticator::requireLogin();
            $conversationModel = new \SchoolAgent\Models\ConversationModel();
            
            // Support both GET (legacy) and POST (AJAX)
            $title = $_POST['title'] ?? $_GET['title'] ?? null;
            
            if ($title) {
                $result = $conversationModel->updateConversation($_GET['id'], ['titre' => $title]);
                
                // Si c'est une requête AJAX, retourner du JSON
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' || $_SERVER['REQUEST_METHOD'] === 'POST') {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => $result > 0]);
                } else {
                    // Sinon redirection classique
                    $_SESSION['success'] = 'Conversation renommée avec succès';
                    header('Location: ?page=conversation');
                    exit;
                }
            }
        }
        break;

    case 'conversation/delete':
        if (isset($_GET['id'])) {
            Authenticator::requireLogin();
            $conversationModel = new \SchoolAgent\Models\ConversationModel();
            $result = $conversationModel->deleteConversation($_GET['id']);
            
            // Si c'est une requête AJAX, retourner du JSON
            if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || $_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Content-Type: application/json');
                echo json_encode(['success' => $result > 0, 'deleted_rows' => $result]);
                exit; // Important : arrêter l'exécution après le JSON
            } else {
                // Sinon redirection classique
                $_SESSION['success'] = 'Conversation supprimée';
                header('Location: ?page=conversation');
                exit;
            }
        }
        break;

    case 'message/create':
        (new MessageController())->create();
        break;

    case 'message/update':
        (new MessageController())->update();
        break;

    case 'message/delete':
        (new MessageController())->delete();
        break;

    // ---------------------------------------------------------------------------
    // PAGES SUBJECT ET LEVEL
    // ---------------------------------------------------------------------------
    case 'subject':
        (new SubjectController())->index();
        break;
        
    case 'subject/show':
        if (isset($_GET['id'])) {
            (new SubjectController())->show($_GET['id']);
        }
        break;
        
    case 'level':
        (new LevelController())->index();
        break;
        
    case 'level/show':
        if (isset($_GET['id'])) {
            (new LevelController())->show($_GET['id']);
        }
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
