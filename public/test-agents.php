<?php
/**
 * Test des agents en base de données
 */

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\AgentModel;
use App\Config\Database;

try {
    // Test connexion
    $db = Database::getInstance();
    echo "✅ Connexion MySQL réussie\n\n";
    
    // Test les agents
    $agentModel = new AgentModel($db);
    $agents = $agentModel->getAll();
    
    echo "=== Agents en Base de Données ===\n";
    echo "Total: " . count($agents) . " agents\n\n";
    
    foreach ($agents as $agent) {
        echo "ID: " . $agent['id_agent'];
        echo " | Nom: " . $agent['nom_agent'];
        echo " | Avatar: " . $agent['avatar'];
        echo "\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "Fichier config: app/Config/database.config.php\n";
}
