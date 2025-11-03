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

$levelInfo = getLevelInfo($level['niveau'] ?? 'Niveau');

// Description personnalisée selon le niveau
function getLevelDescription($levelName) {
    $name = strtolower($levelName);
    
    if (strpos($name, 'maternelle') !== false || strpos($name, 'ps') !== false || strpos($name, 'ms') !== false || strpos($name, 'gs') !== false) {
        return "La maternelle est la première étape de l'école française. Les enfants découvrent l'école, apprennent à vivre ensemble, développent leur langage et commencent à explorer le monde qui les entoure.";
    } elseif (strpos($name, 'cp') !== false) {
        return "Le CP (Cours Préparatoire) marque l'entrée dans l'apprentissage fondamental de la lecture, de l'écriture et du calcul. C'est une année cruciale pour développer les bases de l'éducation.";
    } elseif (strpos($name, 'ce1') !== false || strpos($name, 'ce2') !== false) {
        return "Le CE (Cours Élémentaire) consolide les apprentissages fondamentaux. Les élèves renforcent leur maîtrise de la lecture, de l'écriture et des mathématiques tout en découvrant de nouvelles matières.";
    } elseif (strpos($name, 'cm1') !== false || strpos($name, 'cm2') !== false) {
        return "Le CM (Cours Moyen) prépare l'entrée au collège. Les élèves approfondissent leurs connaissances, développent leur autonomie et découvrent des notions plus complexes dans toutes les matières.";
    } elseif (strpos($name, '6ème') !== false || strpos($name, '6e') !== false) {
        return "La 6ème marque l'entrée au collège. C'est une année d'adaptation où les élèves découvrent de nouveaux professeurs, de nouvelles matières et une organisation différente de leur travail.";
    } elseif (strpos($name, '5ème') !== false || strpos($name, '4ème') !== false || strpos($name, '3ème') !== false) {
        return "Les années de collège permettent d'approfondir les connaissances dans toutes les matières, de développer l'esprit critique et de commencer à construire son projet d'orientation.";
    } elseif (strpos($name, 'seconde') !== false || strpos($name, 'première') !== false || strpos($name, 'terminale') !== false) {
        return "Le lycée prépare au baccalauréat et aux études supérieures. Les élèves se spécialisent progressivement selon leurs goûts et leurs projets d'avenir.";
    } else {
        return "Ce niveau fait partie du parcours scolaire français et permet aux élèves d'acquérir les connaissances et compétences nécessaires à leur épanouissement personnel et à leur réussite future.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($level['niveau'] ?? 'Niveau'); ?> - School Agent</title>
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
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../templates/header.php'; ?>

    <div class="min-h-screen pt-20">
        <div class="container mx-auto px-6 py-12">
            <!-- Level Header -->
            <div class="text-center mb-12">
                <div class="w-32 h-32 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <i class="<?php echo $levelInfo['icon']; ?> text-white text-4xl"></i>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 drop-shadow-lg">
                    <?php echo htmlspecialchars($level['niveau'] ?? 'Niveau'); ?>
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    Découvrez tout ce qu'il faut savoir sur ce niveau scolaire
                </p>
            </div>

            <!-- Main Content -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8">
                    <!-- Description Section -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center gap-3">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            À propos de ce niveau
                        </h2>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                <?php echo getLevelDescription($level['niveau'] ?? 'Niveau'); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Characteristics Section -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-bullseye text-green-600"></i>
                            Objectifs et caractéristiques
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-500">
                                <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-target"></i>
                                    Apprentissages ciblés
                                </h4>
                                <p class="text-blue-700">
                                    Contenus pédagogiques adaptés au niveau de développement et aux capacités des élèves.
                                </p>
                            </div>
                            <div class="bg-green-50 rounded-xl p-6 border-l-4 border-green-500">
                                <h4 class="font-bold text-green-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-users"></i>
                                    Accompagnement personnalisé
                                </h4>
                                <p class="text-green-700">
                                    Agents IA spécialisés pour ce niveau avec des méthodes d'enseignement adaptées.
                                </p>
                            </div>
                            <div class="bg-purple-50 rounded-xl p-6 border-l-4 border-purple-500">
                                <h4 class="font-bold text-purple-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-trophy"></i>
                                    Évaluation continue
                                </h4>
                                <p class="text-purple-700">
                                    Suivi des progrès et évaluation régulière pour optimiser l'apprentissage.
                                </p>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-6 border-l-4 border-orange-500">
                                <h4 class="font-bold text-orange-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-gamepad"></i>
                                    Méthodes ludiques
                                </h4>
                                <p class="text-orange-700">
                                    Approches pédagogiques engageantes et interactives adaptées à l'âge des élèves.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center space-y-4">
                        <a href="?page=conversation&action=create&level=<?php echo $level['id_niveau_scolaire']; ?>" 
                           class="card-hover inline-block bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <i class="fas fa-comments mr-3"></i>
                            Commencer une conversation
                        </a>
                        
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="?page=level" 
                               class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Retour aux niveaux
                            </a>
                            
                            <a href="?page=subject" 
                               class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-gray-400 transition-all duration-200">
                                <i class="fas fa-book-open mr-2"></i>
                                Voir les matières
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
