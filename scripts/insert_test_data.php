<?php
require_once __DIR__ . '/../vendor/autoload.php';
use SchoolAgent\Config\Database;

echo "=== Insertion des données de test ===\n\n";

try {
    $db = Database::getConnection();
    
    // 1. Niveaux scolaires
    echo "1. Insertion des niveaux scolaires...\n";
    $niveaux = [
        'Collège',
        'Lycée', 
        'Université'
    ];
    
    foreach ($niveaux as $niveau) {
        $stmt = $db->prepare("INSERT IGNORE INTO niveau_scolaire (niveau) VALUES (?)");
        $stmt->execute([$niveau]);
    }
    echo "✓ Niveaux scolaires insérés\n\n";
    
    // 2. Agents
    echo "2. Insertion des agents...\n";
    $agents = [
        ['Agent Mathéo', 'math.png', 'Agent spécialisé en mathématiques', 0.7, 'Tu es un assistant de mathématiques.'],
        ['Agent Histoire', 'hist.png', 'Agent passionné d\'histoire et de culture générale', 0.6, 'Tu es un professeur d\'histoire.'],
        ['Agent Scolaire', 'school.png', 'Agent généraliste pour le suivi scolaire', 0.8, 'Tu aides les élèves à organiser leur travail.']
    ];
    
    foreach ($agents as $agent) {
        $stmt = $db->prepare("INSERT IGNORE INTO agent (nom, avatar, description, temperature, system_prompt) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($agent);
    }
    echo "✓ Agents insérés\n\n";
    
    // 3. Matières
    echo "3. Insertion des matières...\n";
    $matieres = [
        ['Mathématiques', 1],
        ['Histoire', 2],
        ['Méthodologie', 3]
    ];
    
    foreach ($matieres as $matiere) {
        $stmt = $db->prepare("INSERT IGNORE INTO matiere (nom, id_agent) VALUES (?, ?)");
        $stmt->execute($matiere);
    }
    echo "✓ Matières insérées\n\n";
    
    // 4. Utilisateurs avec mots de passe sécurisés
    echo "4. Insertion des utilisateurs...\n";
    $utilisateurs = [
        ['Dupont', 'Alice', 'alice.dupont@example.com', password_hash('password1', PASSWORD_DEFAULT), 'etudiant', 1],
        ['Martin', 'Jean', 'jean.martin@example.com', password_hash('password2', PASSWORD_DEFAULT), 'professeur', 2],
        ['Durand', 'Sophie', 'sophie.durand@example.com', password_hash('password3', PASSWORD_DEFAULT), 'admin', 3]
    ];
    
    foreach ($utilisateurs as $user) {
        $stmt = $db->prepare("INSERT IGNORE INTO utilisateur (nom, prenom, email, mot_de_passe, role, id_niveau_scolaire) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute($user);
    }
    echo "✓ Utilisateurs insérés avec mots de passe sécurisés\n\n";
    
    // 5. Logs utilisateur
    echo "5. Insertion des logs utilisateur...\n";
    $logs = [
        [date('Y-m-d H:i:s', strtotime('-1 day')), 1],
        [date('Y-m-d H:i:s', strtotime('-3 days')), 2],
        [date('Y-m-d H:i:s'), 3]
    ];
    
    foreach ($logs as $log) {
        $stmt = $db->prepare("INSERT IGNORE INTO user_log (derniere_connection, id_user) VALUES (?, ?)");
        $stmt->execute($log);
    }
    echo "✓ Logs utilisateur insérés\n\n";
    
    // 6. Relations utilisateur-agent
    echo "6. Insertion des relations utilisateur-agent...\n";
    $relations = [
        [1, 1], // Alice utilise l'agent de math
        [1, 3], // Alice utilise aussi l'agent scolaire
        [2, 2], // Jean (prof) utilise l'agent d'histoire
        [3, 3]  // Sophie (admin) utilise l'agent généraliste
    ];
    
    foreach ($relations as $relation) {
        $stmt = $db->prepare("INSERT IGNORE INTO utiliser (id_user, id_agent) VALUES (?, ?)");
        $stmt->execute($relation);
    }
    echo "✓ Relations utilisateur-agent insérées\n\n";
    
    // 7. Conversations et messages de test
    echo "7. Insertion des conversations et messages...\n";
    $conversations = [
        ['Révision des équations', 1, 1],
        ['Chapitre sur la Révolution française', 2, 2]
    ];
    
    foreach ($conversations as $conv) {
        $stmt = $db->prepare("INSERT IGNORE INTO conversation (titre, id_agent, id_user) VALUES (?, ?, ?)");
        $stmt->execute($conv);
    }
    
    $messages = [
        ['Comment résoudre une équation du second degré ?', 'Utilise la formule du discriminant Δ = b² - 4ac.', 1],
        ['Quand a eu lieu la prise de la Bastille ?', 'Le 14 juillet 1789.', 2]
    ];
    
    foreach ($messages as $msg) {
        $stmt = $db->prepare("INSERT IGNORE INTO message (question, reponse, id_conversation) VALUES (?, ?, ?)");
        $stmt->execute($msg);
    }
    echo "✓ Conversations et messages insérés\n\n";
    
    echo "🎉 Toutes les données de test ont été insérées avec succès !\n\n";
    
    // Afficher un résumé
    echo "=== Résumé des données ===\n";
    $tables = ['niveau_scolaire', 'agent', 'matiere', 'utilisateur', 'conversation', 'message'];
    
    foreach ($tables as $table) {
        $stmt = $db->query("SELECT COUNT(*) as count FROM $table");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "Table '$table' : $count enregistrement(s)\n";
    }
    
    echo "\n=== Comptes utilisateur ===\n";
    echo "alice.dupont@example.com : password1\n";
    echo "jean.martin@example.com : password2\n";
    echo "sophie.durand@example.com : password3\n";
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}
?>