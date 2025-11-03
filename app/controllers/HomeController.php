<?php
namespace schoolAgent\Controllers;

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Config\Authenticator;

class HomeController {
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        $userId = Authenticator::getUserId();
        $recentConversations = [];
        
        if ($userId) {
            // Récupérer les 3 dernières conversations de l'utilisateur
            $conversationModel = new ConversationModel();
            $recentConversations = $conversationModel->getRecentByUserId($userId, 3);
        }
        
        // Charger la vue
        require __DIR__ . '/../Views/home.php';
    }
}
