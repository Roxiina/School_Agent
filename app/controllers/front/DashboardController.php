<?php

namespace SchoolAgent\Controllers\Front;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserAgentModel;
use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\MessageModel;
use SchoolAgent\Models\AgentModel;

class DashboardController
{
    private UserAgentModel $userAgentModel;
    private ConversationModel $conversationModel;
    private MessageModel $messageModel;
    private AgentModel $agentModel;

    public function __construct()
    {
        $this->userAgentModel = new UserAgentModel();
        $this->conversationModel = new ConversationModel();
        $this->messageModel = new MessageModel();
        $this->agentModel = new AgentModel();
    }

    /**
     * Affiche le suivi des agents utilisés par l'utilisateur
     */
    public function agents()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            header('Location: /login');
            exit;
        }

        $userId = Authenticator::getUserId();
        $isLogged = true;

        // Récupérer tous les agents
        $agents = $this->agentModel->getAgents();

        // Récupérer l'historique d'utilisation des agents
        $agentStats = [];
        foreach ($agents as $agent) {
            $agentId = $agent['id_agent'];
            
            // Compter le nombre de conversations avec cet agent
            $conversations = $this->conversationModel->getConversationsByAgentAndUser($agentId, $userId);
            $conversationCount = count($conversations);

            // Compter le nombre de messages
            $messageCount = 0;
            $lastMessageDate = null;
            
            if ($conversationCount > 0) {
                foreach ($conversations as $conv) {
                    $messages = $this->messageModel->getMessagesByConversation($conv['id_conversation']);
                    $messageCount += count($messages);
                    
                    if (!empty($messages)) {
                        $lastMsg = end($messages);
                        // Utiliser la date de création de la conversation comme dernier message
                        if (!$lastMessageDate || strtotime($conv['date_creation']) > strtotime($lastMessageDate)) {
                            $lastMessageDate = $conv['date_creation'];
                        }
                    }
                }
            }

            $agentStats[] = [
                'id_agent' => $agent['id_agent'],
                'nom' => $agent['nom'],
                'conversationCount' => $conversationCount,
                'messageCount' => $messageCount,
                'lastActivity' => $lastMessageDate ? date('d/m/Y à H:i', strtotime($lastMessageDate)) : 'Jamais'
            ];
        }

        // Passer les données à la vue
        $agents = $agentStats;

        // Charger la vue
        require_once __DIR__ . '/../../Views/front/dashboard_agents.php';
    }

    /**
     * Affiche l'historique des conversations par agent
     */
    public function conversations()
    {
        // Vérifier que l'utilisateur est connecté
        if (!Authenticator::isLogged()) {
            header('Location: /login');
            exit;
        }

        $userId = Authenticator::getUserId();
        $isLogged = true;

        // Récupérer tous les agents
        $agents = $this->agentModel->getAgents();

        // Récupérer toutes les conversations groupées par agent
        $conversationsByAgent = [];
        
        foreach ($agents as $agent) {
            $agentId = $agent['id_agent'];
            $conversations = $this->conversationModel->getConversationsByAgentAndUser($agentId, $userId);
            
            // Enrichir les conversations avec les messages
            $enrichedConversations = [];
            foreach ($conversations as $conv) {
                $messages = $this->messageModel->getMessagesByConversation($conv['id_conversation']);
                $enrichedConversations[] = [
                    'conversation' => $conv,
                    'messageCount' => count($messages),
                    'lastMessage' => !empty($messages) ? end($messages) : null
                ];
            }

            if (!empty($enrichedConversations)) {
                $conversationsByAgent[$agent['nom']] = [
                    'agent' => $agent,
                    'conversations' => $enrichedConversations
                ];
            }
        }

        // Charger la vue
        require_once __DIR__ . '/../../Views/front/dashboard_conversations.php';
    }
}
