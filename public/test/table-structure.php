<?php
/**
 * Vérifier la structure de la table agent
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "✅ Connexion réussie\n\n";
    
    // Vérifier structure
    $query = "DESCRIBE agent";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== Colonnes de la table 'agent' ===\n";
    foreach ($columns as $col) {
        echo $col['Field'] . " (" . $col['Type'] . ")\n";
    }
    
    echo "\n=== Contenu de la table ===\n";
    // Essayer de récupérer avec SELECT *
    $query = "SELECT * FROM agent LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Nombre d'agents: " . count($data) . "\n\n";
    foreach ($data as $row) {
        echo json_encode($row, JSON_PRETTY_PRINT) . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
