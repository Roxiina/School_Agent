<?php
/**
 * Test pour vérifier ce que retourne AgentModel::getAgents()
 */

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Models\AgentModel;

try {
    $agentModel = new AgentModel();
    $agents = $agentModel->getAgents();
    
    echo "Agents retournés par getAgents(): " . count($agents) . "\n\n";
    
    foreach ($agents as $agent) {
        echo "ID: {$agent['id_agent']} | Nom: {$agent['nom']}\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
