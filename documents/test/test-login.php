<?php
/**
 * Test du login
 */

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Models\UserModel;

try {
    $userModel = new UserModel();
    
    // Test 1: Chercher l'utilisateur Alice
    echo "=== Test getUserByEmail ===\n";
    $user = $userModel->getUserByEmail('alice.dupont@example.com');
    
    if ($user) {
        echo "✅ Utilisateur trouvé:\n";
        echo "  Email: {$user['email']}\n";
        echo "  Nom: {$user['nom']} {$user['prenom']}\n";
        echo "  Password hash: " . substr($user['mot_de_passe'], 0, 30) . "...\n";
        
        // Test 2: Vérifier le password
        echo "\n=== Test password_verify ===\n";
        
        // Essayer avec le bon password (Alice123)
        $testPassword = 'Alice123';
        $verified = password_verify($testPassword, $user['mot_de_passe']);
        
        echo "Password testé: '$testPassword'\n";
        echo "Résultat: " . ($verified ? '✅ OK' : '❌ FAIL') . "\n";
        
    } else {
        echo "❌ Utilisateur non trouvé\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
