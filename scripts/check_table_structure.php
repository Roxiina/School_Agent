<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Config\Database;

try {
    $db = Database::getConnection();
    
    // Afficher la structure de la table utilisateur
    echo "Structure de la table utilisateur:\n";
    $stmt = $db->query("DESCRIBE utilisateur");
    while ($column = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- {$column['Field']} ({$column['Type']}) {$column['Null']} {$column['Key']}\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}
?>