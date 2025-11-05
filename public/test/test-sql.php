<?php
/**
 * Test SQL direct
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "=== Test 1: SELECT * FROM agent ===\n";
    $stmt = $pdo->query("SELECT * FROM agent ORDER BY id_agent ASC");
    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Résultat: " . count($result1) . " agents\n";
    foreach ($result1 as $row) {
        echo "  ID {$row['id_agent']}: {$row['nom']}\n";
    }
    
    echo "\n=== Test 2: Via PDO prepare ===\n";
    $stmt2 = $pdo->prepare("SELECT * FROM agent ORDER BY id_agent ASC");
    $stmt2->execute();
    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo "Résultat: " . count($result2) . " agents\n";
    foreach ($result2 as $row) {
        echo "  ID {$row['id_agent']}: {$row['nom']}\n";
    }
    
    echo "\n=== Test 3: Count(*) ===\n";
    $stmt3 = $pdo->query("SELECT COUNT(*) as total FROM agent");
    $count = $stmt3->fetch(PDO::FETCH_ASSOC);
    echo "Total count: " . $count['total'] . "\n";
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}
