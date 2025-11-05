<?php
/**
 * Test direct SQL pour vérifier les agents
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    // Connexion PDO directe
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "✅ Connexion MySQL réussie\n";
    echo "Host: {$config['host']}\n";
    echo "Port: {$config['port']}\n";
    echo "Database: {$config['dbname']}\n\n";
    
    // Requête pour les agents
    $query = "SELECT id_agent, nom_agent, avatar FROM agent ORDER BY id_agent ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== Agents en Base de Données ===\n";
    echo "Total: " . count($agents) . " agents\n\n";
    
    foreach ($agents as $agent) {
        echo "ID: " . $agent['id_agent'];
        echo " | Nom: " . $agent['nom_agent'];
        echo " | Avatar: " . $agent['avatar'];
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
