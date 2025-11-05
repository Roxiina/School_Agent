<?php
/**
 * Vérifier les détails des utilisateurs
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "=== Utilisateurs détails ===\n\n";
    
    $query = "SELECT id_user, email, prenom, nom, role, mot_de_passe FROM utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        echo "ID: {$user['id_user']}\n";
        echo "  Email: {$user['email']}\n";
        echo "  Nom: {$user['nom']} {$user['prenom']}\n";
        echo "  Rôle: {$user['role']}\n";
        echo "  Password: " . (empty($user['mot_de_passe']) ? '❌ VIDE!' : '✅ ' . substr($user['mot_de_passe'], 0, 30) . '...') . "\n";
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
