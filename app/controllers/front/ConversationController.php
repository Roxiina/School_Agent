<?php
namespace SchoolAgent\Controllers\Front;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\AgentModel;
use SchoolAgent\Models\UserModel;
use SchoolAgent\Config\Authenticator;

class ConversationController {
    private $conversationModel;
    private $agentModel;

    public function __construct() {
        $this->conversationModel = new ConversationModel();
        $this->agentModel = new AgentModel();
    }

    /**
     * Affiche la page de conversation
     */
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        $isLogged = Authenticator::isLogged();
        $user = [];
        
        if ($isLogged) {
            // Récupérer l'utilisateur connecté
            $userId = Authenticator::getUserId();
            $userModel = new UserModel();
            $user = $userModel->getUser($userId) ?? [];
        } else {
            // Rediriger vers login si pas connecté
            header('Location: /login');
            exit;
        }

        // Récupérer tous les agents
        $agents = $this->agentModel->getAgents();

        // Récupérer l'ID de l'agent s'il est passé en paramètre
        $agentId = $_GET['agent'] ?? null;
        $agent = null;

        if ($agentId) {
            $agent = $this->agentModel->getAgent($agentId);
        }

        // Charger la vue
        require_once __DIR__ . '/../../Views/front/conversation.php';
    }
}
