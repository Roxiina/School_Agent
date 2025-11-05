<?php
/**
 * API Endpoint: Create new conversation
 * POST /api/conversation/create
 */

header('Content-Type: application/json');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the autoloader
require __DIR__ . '/../../vendor/autoload.php';

use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\AgentModel;
use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;

try {
    // Check if user is logged in
    $isLogged = Authenticator::isLogged();
    if (!$isLogged) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Utilisateur non authentifié'
        ]);
        exit;
    }

    // Get user ID
    $userId = Authenticator::getUserId();
    $userModel = new UserModel();
    $user = $userModel->getUser($userId);

    if (!$user) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Utilisateur introuvable'
        ]);
        exit;
    }

    // Get request data
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['agent_id']) || !isset($data['agent_name'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Paramètres manquants'
        ]);
        exit;
    }

    $agentId = (int)$data['agent_id'];
    $agentName = trim($data['agent_name']);

    // Verify agent exists
    $agentModel = new AgentModel();
    $agent = $agentModel->getAgent($agentId);

    if (!$agent) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Agent introuvable'
        ]);
        exit;
    }

    // Create new conversation
    $conversationModel = new ConversationModel();
    $conversationData = [
        'titre' => 'Conversation avec ' . $agentName . ' - ' . date('d/m/Y H:i'),
        'date_creation' => date('Y-m-d H:i:s'),
        'id_agent' => $agentId,
        'id_user' => $userId
    ];

    // Insert the conversation
    $conversationModel->createConversation($conversationData);

    // Get the last inserted ID
    $conversations = $conversationModel->getConversationsByAgentAndUser($agentId, $userId);
    if (!empty($conversations)) {
        $newConversation = $conversations[0]; // Most recent first
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Conversation créée avec succès',
            'conversation_id' => $newConversation['id_conversation']
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la création de la conversation'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
?>
