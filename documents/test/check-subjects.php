<?php
/**
 * Vérifier les matières en base de données
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "=== Matières en BD ===\n\n";
    
    $query = "SELECT id_matiere, nom, id_agent FROM matiere";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Total: " . count($subjects) . " matières\n\n";
    
    foreach ($subjects as $subject) {
        echo "ID: {$subject['id_matiere']} | Nom: {$subject['nom']} | Agent ID: {$subject['id_agent']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
