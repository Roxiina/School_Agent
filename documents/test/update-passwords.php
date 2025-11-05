<?php
/**
 * Mettre à jour les mots de passe en bcrypt
 */

$config = include __DIR__ . '/../app/Config/database.config.php';

try {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    
    echo "=== Mise à jour des mots de passe ===\n\n";
    
    // Récupérer tous les utilisateurs
    $query = "SELECT id_user, email, mot_de_passe FROM utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        $oldPassword = $user['mot_de_passe'];
        
        // Si c'est un MD5 (32 caractères hexadécimaux), on le replace
        if (strlen($oldPassword) === 32 && ctype_xdigit($oldPassword)) {
            // Créer un nouveau hash bcrypt avec le password original
            // Déduire le password original du contexte
            $passwordMap = [
                'alice.dupont@example.com' => 'password1',
                'jean.martin@example.com' => 'password2',
                'sophie.durand@example.com' => 'password3'
            ];
            
            $plainPassword = $passwordMap[$user['email']] ?? null;
            
            if ($plainPassword) {
                $newHash = password_hash($plainPassword, PASSWORD_DEFAULT);
                
                $updateQuery = "UPDATE utilisateur SET mot_de_passe = :password WHERE id_user = :id";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->execute([
                    ':password' => $newHash,
                    ':id' => $user['id_user']
                ]);
                
                echo "✅ {$user['email']}: Mis à jour en bcrypt\n";
            }
        } else {
            echo "⏭️  {$user['email']}: Déjà en bcrypt\n";
        }
    }
    
    echo "\n=== Test des nouveaux passwords ===\n";
    
    // Tester les logins
    $passwords = [
        'alice.dupont@example.com' => 'password1',
        'jean.martin@example.com' => 'password2',
        'sophie.durand@example.com' => 'password3'
    ];
    
    foreach ($passwords as $email => $password) {
        $stmt = $pdo->prepare("SELECT mot_de_passe FROM utilisateur WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            echo "✅ $email avec '$password': OK\n";
        } else {
            echo "❌ $email avec '$password': FAIL\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
