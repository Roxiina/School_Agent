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
    MessageController,
    PrivacyController
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

// -------------------------------------------------------------
// Routing via switch-case
// -------------------------------------------------------------
switch ($page) {
    case 'home':
    case '':
        // Page d'accueil publique - accessible à tous
        $controller = new HomeController();
        $controller->index();
        break;

    case 'dashboard':
        // Tableau de bord - nécessite une connexion
        Authenticator::requireLogin();
        $controller = new HomeController();
        $controller->dashboard();
        break;

    case 'login':
        // Si déjà connecté, rediriger vers dashboard
        if (Authenticator::isLogged()) {
            header('Location: ?page=dashboard');
            exit;
        }
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;
    
    // Routes pour la confidentialité (RGPD)
    case 'privacy':
        $controller = new PrivacyController();
        $controller->index();
        break;
        
    case 'privacy-policy':
    case 'terms':
        $controller = new PrivacyController();
        $controller->terms();
        break;
        
    case 'cookies':
    case 'cookie-policy':
        $controller = new PrivacyController();
        $controller->cookies();
        break;
        
    case 'data-request':
        $controller = new PrivacyController();
        $controller->dataRequest();
        break;
        
    case 'contact':
        $controller = new PrivacyController();
        $controller->contact();
        break;
    
    
        // Liste des utilisateurs
    case 'user':
        $controller = new UserController();
        $controller->index();
        break;

    // Profil de l'utilisateur connecté
    case 'profile':
        $controller = new UserController();
        $controller->profile();
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
// ---------------------------------------------------------------------------
    // Liste des NIVEAUX -----------------------------------------------------
    case 'level':
        $controller = new LevelController();
        $controller->index();
        break;

    // Afficher le niveau
    // Exemple : http://localhost:8000/level/show?id=4
    case 'level/show':
    if (isset($_GET['id'])) {
        $controller = new LevelController();
        $controller->show($_GET['id']);
    } else {
        echo "<h1>Erreur : ID manquant</h1>";
    }
    break;

    // Formulaire création niveau
    case 'level/create':
        $controller = new LevelController();
        $controller->create();
        break;
    
    // Formulaire édition niveau
    // http://localhost:8000/level/edit/?id=4
    case 'level/edit':
        if (isset($_GET['id'])) {
            $controller = new LevelController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression niveau
    // http://localhost:8000/level/delete/?id=4
    case 'level/delete':
        if (isset($_GET['id'])) {
            $controller = new LevelController();
            $controller->delete($_GET['id']);
        }
        break;
// ---------------------------------------------------------------------------
    // Liste des MATIERES ----------------------------------------------------
    case 'subject':
        $controller = new SubjectController();
        $controller->index();
        break;

    // Afficher la matière
    // Exemple : http://localhost:8000/subject/show?id=4
    case 'subject/show':
    if (isset($_GET['id'])) {
        $controller = new SubjectController();
        $controller->show($_GET['id']);
    } else {
        echo "<h1>Erreur : ID manquant</h1>";
    }
    break;

    // Formulaire création matière
    case 'subject/create':
        $controller = new SubjectController();
        $controller->create();
        break;
    
    // Formulaire édition matière
    // http://localhost:8000/subject/edit/?id=4
    case 'subject/edit':
        if (isset($_GET['id'])) {
            $controller = new SubjectController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression matière
    // http://localhost:8000/subject/delete/?id=4
    case 'subject/delete':
        if (isset($_GET['id'])) {
            $controller = new SubjectController();
            $controller->delete($_GET['id']);
        }
        break;

    // ---------------------------------------------------------------------------
    // Liste des MESSAGES --------------------------------------------------------
    case 'message':
        $controller = new MessageController();
        $controller->index();
        break;

    // Afficher le message
    // Exemple : http://localhost:8000/message/show?id=4
    case 'message/show':
    if (isset($_GET['id'])) {
        $controller = new MessageController();
        $controller->show($_GET['id']);
    } else {
        echo "<h1>Erreur : ID manquant</h1>";
    }
    break;

    // Formulaire création message
    case 'message/create':
        $controller = new MessageController();
        $controller->create();
        break;
    
    // Formulaire édition message
    // http://localhost:8000/message/edit/?id=4
    case 'message/edit':
        if (isset($_GET['id'])) {
            $controller = new MessageController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression message
    // http://localhost:8000/message/delete/?id=4
    case 'message/delete':
        if (isset($_GET['id'])) {
            $controller = new MessageController();
            $controller->delete($_GET['id']);
        }
        break;
// ----------------------------------------------------------------------------

//--------------------------------------------------------------------------
    // Liste des CONVERSATIONS-----------------------------------------------
    case 'conversation':
        $controller = new ConversationController();
        $controller->index();
        break;

    // Afficher la conversation
    // Exemple : http://localhost:8000/conversation/show?id=4
    case 'conversation/show':
    if (isset($_GET['id'])) {
        $controller = new ConversationController();
        $controller->show($_GET['id']);
    } else {
        echo "<h1>Erreur : ID manquant</h1>";
    }
    break;

    // Formulaire création conversation
    case 'conversation/create':
        $controller = new ConversationController();
        $controller->create();
        break;
    
    // Formulaire édition conversation
    // http://localhost:8000/conversation/edit/?id=4
    case 'conversation/edit':
        if (isset($_GET['id'])) {
            $controller = new ConversationController();
            $controller->edit($_GET['id']);
        }
        break;

    // Suppression conversation
    // http://localhost:8000/conversation/delete/?id=4
    case 'conversation/delete':
        if (isset($_GET['id'])) {
            $controller = new ConversationController();
            $controller->delete($_GET['id']);
        }
        break;
// ---------------------------------------------------------------------------

    // Page non trouvée
    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée, relis ton code !</h1>";
        break;
}
