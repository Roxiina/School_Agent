<?php
$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    // Requête pour tous les agents
    $query = "SELECT * FROM agent ORDER BY id_agent ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Total agents en BD: " . count($agents) . "\n\n";
    
    foreach ($agents as $agent) {
        echo "=== Agent ID {$agent['id_agent']} ===\n";
        foreach ($agent as $key => $value) {
            echo "$key: " . (is_null($value) ? 'NULL' : substr($value, 0, 60)) . "\n";
        }
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}
