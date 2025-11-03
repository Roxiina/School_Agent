<?php
require_once 'vendor/autoload.php';
use SchoolAgent\Models\ConversationModel;

echo "=== TEST COMPTEUR CONVERSATIONS PAR AGENT ===" . PHP_EOL . PHP_EOL;

$convModel = new ConversationModel();
$conversationsByAgent = $convModel->getConversationCountByAgent(1);

echo "Utilisateur 1 (Alice) - Conversations par agent:" . PHP_EOL;
foreach ($conversationsByAgent as $agentConv) {
    echo "- " . $agentConv['agent_nom'] . ": " . $agentConv['conversation_count'] . " conversation(s)" . PHP_EOL;
}
