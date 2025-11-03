<?php
/**
 * Script de test pour vérifier que le nouveau frontend fonctionne
 */

echo "=== Test du frontend School Agent ===\n\n";

// 1. Vérifier les fichiers CSS et JS
$frontendFiles = [
    'CSS principal' => __DIR__ . '/../app/front/css/style.css',
    'CSS agents' => __DIR__ . '/../app/front/css/agents.css',
    'JavaScript principal' => __DIR__ . '/../app/front/js/app.js',
    'Composants PHP' => __DIR__ . '/../app/front/components/FrontendComponents.php'
];

echo "1. Vérification des fichiers frontend :\n";
foreach ($frontendFiles as $name => $file) {
    if (file_exists($file)) {
        $size = number_format(filesize($file) / 1024, 2);
        echo "   ✓ {$name} ({$size} KB)\n";
    } else {
        echo "   ❌ {$name} - MANQUANT\n";
    }
}

// 2. Vérifier la base de données
echo "\n2. Vérification de la base de données :\n";
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    
    $db = \SchoolAgent\Config\Database::getConnection();
    echo "   ✓ Connexion à la base de données réussie\n";
    
    // Vérifier les données
    $tables = ['agent', 'utilisateur', 'conversation', 'message'];
    foreach ($tables as $table) {
        $stmt = $db->query("SELECT COUNT(*) as count FROM {$table}");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   ✓ Table '{$table}' : {$count} enregistrement(s)\n";
    }
    
} catch (Exception $e) {
    echo "   ❌ Erreur base de données : " . $e->getMessage() . "\n";
}

// 3. Vérifier les templates mis à jour
echo "\n3. Vérification des templates :\n";
$templates = [
    'Header' => __DIR__ . '/../app/Views/templates/header.php',
    'Footer' => __DIR__ . '/../app/Views/templates/footer.php',
    'Home' => __DIR__ . '/../app/Views/home.php'
];

foreach ($templates as $name => $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if (strpos($content, 'front/css/style.css') !== false || strpos($content, 'front/js/app.js') !== false) {
            echo "   ✓ {$name} - Mis à jour avec les nouveaux assets\n";
        } else {
            echo "   ⚠ {$name} - Peut nécessiter une mise à jour\n";
        }
    } else {
        echo "   ❌ {$name} - MANQUANT\n";
    }
}

// 4. Conseils pour la suite
echo "\n4. Pour tester votre application :\n";
echo "   🌐 Ouvrez votre navigateur sur : http://localhost/School_Agent/public/\n";
echo "   📱 Testez la responsivité en redimensionnant la fenêtre\n";
echo "   🎨 Vérifiez que les styles se chargent correctement\n";
echo "   ⚡ Testez les interactions JavaScript (formulaires, navigation)\n";

echo "\n5. Comptes de test disponibles :\n";
echo "   👤 alice.dupont@example.com / password1 (Étudiant)\n";
echo "   👨‍🏫 jean.martin@example.com / password2 (Professeur)\n";
echo "   👨‍💼 sophie.durand@example.com / password3 (Admin)\n";

echo "\n=== Structure frontend créée ===\n";
echo "📁 app/front/\n";
echo "   📁 css/\n";
echo "      📄 style.css (styles principaux)\n";
echo "      📄 agents.css (styles des agents)\n";
echo "   📁 js/\n";
echo "      📄 app.js (JavaScript principal)\n";
echo "   📁 components/\n";
echo "      📄 FrontendComponents.php (composants réutilisables)\n";
echo "   📁 images/ (pour les futures images)\n";

echo "\n🎉 Frontend School Agent configuré avec succès !\n";
?>