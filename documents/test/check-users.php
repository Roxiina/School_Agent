<?php
/**
 * Vérifier les utilisateurs en base de données
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "✅ Connexion réussie\n\n";
    
    // Vérifier la structure de la table utilisateur
    echo "=== Structure table utilisateur ===\n";
    $query = "DESCRIBE utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $col) {
        echo $col['Field'] . " (" . $col['Type'] . ")\n";
    }
    
    // Vérifier les utilisateurs
    echo "\n=== Utilisateurs en BD ===\n";
    $query = "SELECT * FROM utilisateur LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Total: " . count($users) . " utilisateurs\n\n";
    
    foreach ($users as $user) {
        echo "ID: {$user['id_user']} | Email: {$user['email']} | Prenom: {$user['prenom']} | Password hash: " . substr($user['password_hash'] ?? '', 0, 20) . "...\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
