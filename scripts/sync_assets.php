<?php
/**
 * Script pour synchroniser les assets frontend
 */

echo "=== Synchronisation des assets frontend ===\n\n";

$sourceDir = __DIR__ . '/../app/front';
$publicDir = __DIR__ . '/../public';

// Créer les dossiers nécessaires
$directories = ['css', 'js', 'images'];
foreach ($directories as $dir) {
    $targetDir = $publicDir . '/' . $dir;
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
        echo "✓ Dossier créé : {$dir}/\n";
    }
}

// Copier les fichiers CSS
$cssFiles = [
    'style.css',
    'agents.css'
];

foreach ($cssFiles as $file) {
    $source = $sourceDir . '/css/' . $file;
    $target = $publicDir . '/css/' . $file;
    
    if (file_exists($source)) {
        copy($source, $target);
        echo "✓ CSS copié : {$file}\n";
    } else {
        echo "❌ CSS manquant : {$file}\n";
    }
}

// Copier les fichiers JS
$jsFiles = [
    'app.js'
];

foreach ($jsFiles as $file) {
    $source = $sourceDir . '/js/' . $file;
    $target = $publicDir . '/js/' . $file;
    
    if (file_exists($source)) {
        copy($source, $target);
        echo "✓ JS copié : {$file}\n";
    } else {
        echo "❌ JS manquant : {$file}\n";
    }
}

// Vérifier les permissions
echo "\n=== Vérification des assets ===\n";
$assets = [
    'css/style.css',
    'css/agents.css',
    'js/app.js'
];

foreach ($assets as $asset) {
    $file = $publicDir . '/' . $asset;
    if (file_exists($file)) {
        $size = round(filesize($file) / 1024, 2);
        echo "✓ {$asset} ({$size} KB)\n";
    } else {
        echo "❌ {$asset} - Manquant\n";
    }
}

echo "\n🎉 Synchronisation terminée !\n";
echo "📁 Les assets sont maintenant dans public/css/ et public/js/\n";
echo "🌐 Testez votre site sur : http://localhost/School_Agent/public/\n";
?>