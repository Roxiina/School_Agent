<?php
// scripts/update_passwords.php
require_once __DIR__ . '/../vendor/autoload.php'; // charge les dépendances

use SchoolAgent\Config\Database;

$map = [
    'alice.dupont@example.com' => 'password1',
    'jean.martin@example.com'  => 'password2',
    'sophie.durand@example.com'=> 'password3',
];

try {
    $db = Database::getConnection();
} catch (Exception $e) {
    die("Erreur connexion DB: " . $e->getMessage() . PHP_EOL);
}

foreach ($map as $email => $plain) {
    $hash = password_hash($plain, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE utilisateur SET mot_de_passe = :hash WHERE email = :email");
    $stmt->execute([':hash' => $hash, ':email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo "OK : mise à jour de $email\n";
    } else {
        echo "ATTENTION : aucun utilisateur trouvé pour $email (ou déjà à jour)\n";
    }
}

echo "Terminé.\n";
