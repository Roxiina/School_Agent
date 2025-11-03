<?php
require_once __DIR__ . '/../vendor/autoload.php';
use SchoolAgent\Config\Database;

echo "=== Vérification de l'état de la base de données ===\n\n";

try {
    $db = Database::getConnection();
    echo "✓ Connexion à la base de données réussie\n\n";
    
    // Vérifier les tables
    $tables = ['niveau_scolaire', 'agent', 'matiere', 'utilisateur', 'conversation', 'message'];
    
    foreach ($tables as $table) {
        $stmt = $db->query("SELECT COUNT(*) as count FROM $table");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "Table '$table' : $count enregistrement(s)\n";
    }
    
    echo "\n=== Détail des utilisateurs ===\n";
    $stmt = $db->query("SELECT id_user, nom, prenom, email FROM utilisateur");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($users)) {
        echo "Aucun utilisateur trouvé dans la base de données.\n";
    } else {
        foreach ($users as $user) {
            echo "- ID: {$user['id_user']}, Nom: {$user['nom']} {$user['prenom']}, Email: {$user['email']}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}
?>