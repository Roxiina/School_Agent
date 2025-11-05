<?php
/**
 * Test pour vérifier si la page conversation affiche tous les agents
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "✅ Connexion réussie\n\n";
    
    // Requête pour les agents
    $query = "SELECT id_agent, nom, avatar FROM agent ORDER BY id_agent ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== Test Affichage Agents ===\n";
    echo "Total: " . count($agents) . " agents\n\n";
    
    foreach ($agents as $agent) {
        // Simuler le getAgentIcon
        $name = strtolower($agent['nom']);
        $icon = 'fas fa-robot';
        
        if (strpos($name, 'math') !== false || strpos($agent['avatar'], 'math') !== false) {
            $icon = 'fas fa-calculator';
        } elseif (strpos($name, 'histoire') !== false || strpos($agent['avatar'], 'hist') !== false) {
            $icon = 'fas fa-book-open';
        } elseif (strpos($name, 'scolaire') !== false || strpos($agent['avatar'], 'school') !== false) {
            $icon = 'fas fa-graduation-cap';
        } elseif (strpos($name, 'français') !== false) {
            $icon = 'fas fa-pen-fancy';
        } elseif (strpos($name, 'science') !== false) {
            $icon = 'fas fa-flask';
        } elseif (strpos($name, 'english') !== false || strpos($name, 'anglais') !== false) {
            $icon = 'fas fa-flag';
        }
        
        echo "ID: {$agent['id_agent']} | Nom: {$agent['nom']} | Avatar: {$agent['avatar']} | Icon: {$icon}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
