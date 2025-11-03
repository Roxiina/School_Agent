<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Config\Database;

try {
    echo "Tentative de connexion à la base de données...\n";
    $db = Database::getConnection();
    echo "✅ Connexion réussie!\n";
    
    // Vérifier l'utilisateur Sophie
    echo "Recherche de l'utilisateur Sophie...\n";
    $stmt = $db->prepare("SELECT id_user, nom, prenom, email, role FROM utilisateur WHERE email = ?");
    $stmt->execute(['sophie.durand@example.com']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✅ Utilisateur trouvé:\n";
        echo "ID: " . $user['id_user'] . "\n";
        echo "Nom: " . $user['nom'] . " " . $user['prenom'] . "\n";
        echo "Email: " . $user['email'] . "\n";
        echo "Rôle: " . $user['role'] . "\n";
        
        if ($user['role'] === 'admin') {
            echo "✅ L'utilisateur a bien le rôle admin\n";
        } else {
            echo "❌ L'utilisateur n'a PAS le rôle admin (rôle actuel: " . $user['role'] . ")\n";
            
            // Corriger le rôle
            echo "Correction du rôle en admin...\n";
            $updateStmt = $db->prepare("UPDATE utilisateur SET role = 'admin' WHERE email = ?");
            $updateStmt->execute(['sophie.durand@example.com']);
            echo "✅ Rôle mis à jour vers admin\n";
        }
    } else {
        echo "❌ Utilisateur non trouvé avec l'email sophie.durand@example.com\n";
        
        // Afficher tous les utilisateurs
        echo "Liste de tous les utilisateurs:\n";
        $allStmt = $db->query("SELECT id_user, nom, prenom, email, role FROM utilisateur");
        while ($row = $allStmt->fetch(PDO::FETCH_ASSOC)) {
            echo "- ID: {$row['id_user']}, Nom: {$row['nom']} {$row['prenom']}, Email: {$row['email']}, Rôle: {$row['role']}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
?>