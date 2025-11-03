<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonction pour obtenir l'icône et la couleur du niveau
function getLevelInfo($levelName) {
    $name = strtolower($levelName);
    
    if (strpos($name, 'maternelle') !== false || strpos($name, 'ps') !== false || strpos($name, 'ms') !== false || strpos($name, 'gs') !== false) {
        return ['icon' => 'fas fa-baby', 'color' => 'from-pink-500 to-rose-600'];
    } elseif (strpos($name, 'cp') !== false || strpos($name, 'ce1') !== false || strpos($name, 'ce2') !== false) {
        return ['icon' => 'fas fa-child', 'color' => 'from-green-500 to-emerald-600'];
    } elseif (strpos($name, 'cm1') !== false || strpos($name, 'cm2') !== false) {
        return ['icon' => 'fas fa-user-graduate', 'color' => 'from-blue-500 to-cyan-600'];
    } elseif (strpos($name, '6ème') !== false || strpos($name, '6e') !== false || strpos($name, 'sixième') !== false) {
        return ['icon' => 'fas fa-school', 'color' => 'from-purple-500 to-violet-600'];
    } elseif (strpos($name, '5ème') !== false || strpos($name, '5e') !== false || strpos($name, 'cinquième') !== false) {
        return ['icon' => 'fas fa-book-open', 'color' => 'from-indigo-500 to-blue-600'];
    } elseif (strpos($name, '4ème') !== false || strpos($name, '4e') !== false || strpos($name, 'quatrième') !== false) {
        return ['icon' => 'fas fa-pencil-alt', 'color' => 'from-teal-500 to-cyan-600'];
    } elseif (strpos($name, '3ème') !== false || strpos($name, '3e') !== false || strpos($name, 'troisième') !== false) {
        return ['icon' => 'fas fa-award', 'color' => 'from-orange-500 to-amber-600'];
    } elseif (strpos($name, 'seconde') !== false || strpos($name, '2nde') !== false) {
        return ['icon' => 'fas fa-rocket', 'color' => 'from-red-500 to-pink-600'];
    } elseif (strpos($name, 'première') !== false || strpos($name, '1ère') !== false) {
        return ['icon' => 'fas fa-star', 'color' => 'from-yellow-500 to-orange-500'];
    } elseif (strpos($name, 'terminale') !== false || strpos($name, 'term') !== false) {
        return ['icon' => 'fas fa-trophy', 'color' => 'from-gold-500 to-yellow-600'];
    } else {
        return ['icon' => 'fas fa-graduation-cap', 'color' => 'from-gray-500 to-slate-600'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niveaux Scolaires - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.3);
        }
        .level-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="min-h-screen pt-20">
        <div class="container mx-auto px-6 py-12">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-white mb-4 drop-shadow-lg">
                    <i class="fas fa-layer-group mr-4"></i>
                    Niveaux Scolaires
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto">
                    Découvrez tous les niveaux scolaires disponibles et trouvez celui qui correspond à votre parcours éducatif
                </p>
            </div>

            <!-- Levels Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php if (!empty($levels)): ?>
                    <?php foreach ($levels as $level): 
                        $levelInfo = getLevelInfo($level['niveau']);
                    ?>
                        <div class="card-hover level-card">
                            <div class="text-center">
                                <!-- Icon -->
                                <div class="w-16 h-16 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <i class="<?php echo $levelInfo['icon']; ?> text-white text-xl"></i>
                                </div>
                                
                                <!-- Level Name -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <?php echo htmlspecialchars($level['niveau']); ?>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    Explorez les ressources et agents spécialisés pour ce niveau scolaire.
                                </p>
                                
                                <!-- Action Buttons -->
                                <div class="space-y-2">
                                    <a href="?page=level&action=show&id=<?php echo $level['id_niveau_scolaire']; ?>" 
                                       class="block w-full bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition-all duration-200 text-sm">
                                        <i class="fas fa-eye mr-2"></i>
                                        Voir les détails
                                    </a>
                                    
                                    <a href="?page=conversation&action=create&level=<?php echo $level['id_niveau_scolaire']; ?>" 
                                       class="block w-full bg-white border-2 border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:border-gray-400 hover:shadow-md transition-all duration-200 text-sm">
                                        <i class="fas fa-comments mr-2"></i>
                                        Commencer
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-16">
                        <div class="level-card max-w-md mx-auto">
                            <i class="fas fa-layer-group text-6xl text-gray-400 mb-6"></i>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun niveau disponible</h3>
                            <p class="text-gray-600">
                                Les niveaux scolaires seront bientôt disponibles. Revenez plus tard !
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <div class="text-center mt-12">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="?page=home" class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à l'accueil
                    </a>
                    
                    <a href="?page=subject" class="inline-flex items-center px-6 py-3 bg-white border-2 border-white text-gray-700 rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-book-open mr-2"></i>
                        Voir les matières
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>