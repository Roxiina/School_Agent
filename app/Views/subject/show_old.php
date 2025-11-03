<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonctions pour les icônes et couleurs des agents
function getSubjectIconPHP($subjectName) {
    $name = strtolower($subjectName);
    
    if (strpos($name, 'math') !== false || strpos($name, 'calcul') !== false) {
        return 'fas fa-calculator';
    } elseif (strpos($name, 'science') !== false || strpos($name, 'physique') !== false || strpos($name, 'chimie') !== false || strpos($name, 'biologie') !== false) {
        return 'fas fa-flask';
    } elseif (strpos($name, 'histoire') !== false || strpos($name, 'géographie') !== false || strpos($name, 'geo') !== false) {
        return 'fas fa-globe';
    } elseif (strpos($name, 'littérature') !== false || strpos($name, 'français') !== false || strpos($name, 'lecture') !== false) {
        return 'fas fa-book';
    } elseif (strpos($name, 'anglais') !== false || strpos($name, 'langue') !== false) {
        return 'fas fa-language';
    } elseif (strpos($name, 'art') !== false || strpos($name, 'dessin') !== false || strpos($name, 'peinture') !== false) {
        return 'fas fa-palette';
    } elseif (strpos($name, 'musique') !== false) {
        return 'fas fa-music';
    } elseif (strpos($name, 'sport') !== false || strpos($name, 'eps') !== false) {
        return 'fas fa-dumbbell';
    } elseif (strpos($name, 'informatique') !== false || strpos($name, 'code') !== false || strpos($name, 'programmation') !== false) {
        return 'fas fa-laptop-code';
    } else {
        return 'fas fa-graduation-cap';
    }
}

function getSubjectColorPHP($subjectName) {
    $name = strtolower($subjectName);
    
    if (strpos($name, 'math') !== false || strpos($name, 'calcul') !== false) {
        return 'from-blue-600 to-indigo-700';
    } elseif (strpos($name, 'science') !== false || strpos($name, 'physique') !== false || strpos($name, 'chimie') !== false || strpos($name, 'biologie') !== false) {
        return 'from-green-600 to-emerald-700';
    } elseif (strpos($name, 'histoire') !== false || strpos($name, 'géographie') !== false || strpos($name, 'geo') !== false) {
        return 'from-amber-600 to-orange-700';
    } elseif (strpos($name, 'littérature') !== false || strpos($name, 'français') !== false || strpos($name, 'lecture') !== false) {
        return 'from-purple-600 to-violet-700';
    } elseif (strpos($name, 'anglais') !== false || strpos($name, 'langue') !== false) {
        return 'from-red-600 to-rose-700';
    } elseif (strpos($name, 'art') !== false || strpos($name, 'dessin') !== false || strpos($name, 'peinture') !== false) {
        return 'from-pink-600 to-fuchsia-700';
    } elseif (strpos($name, 'musique') !== false) {
        return 'from-teal-600 to-cyan-700';
    } elseif (strpos($name, 'sport') !== false || strpos($name, 'eps') !== false) {
        return 'from-emerald-600 to-green-700';
    } elseif (strpos($name, 'informatique') !== false || strpos($name, 'code') !== false || strpos($name, 'programmation') !== false) {
        return 'from-slate-600 to-gray-700';
    } else {
        return 'from-indigo-600 to-purple-600';
    }
}

$subjectIcon = getSubjectIconPHP($subject['nom'] ?? 'Matière');
$subjectColor = getSubjectColorPHP($subject['nom'] ?? 'Matière');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject['nom'] ?? 'Matière'); ?> - School Agent</title>
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
            <!-- Subject Header -->
            <div class="text-center mb-12">
                <div class="w-32 h-32 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <i class="<?php echo $subjectIcon; ?> text-white text-4xl"></i>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 drop-shadow-lg">
                    <?php echo htmlspecialchars($subject['nom'] ?? 'Matière'); ?>
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    Découvrez tout ce que vous devez savoir sur cette matière passionnante
                </p>
            </div>

            <!-- Main Content -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8">
                    <!-- Description Section -->
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center gap-3">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            À propos de cette matière
                        </h2>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Cette matière fait partie du programme scolaire et vous permettra d'acquérir des connaissances 
                                et des compétences essentielles. Notre agent spécialisé est là pour vous accompagner dans votre 
                                apprentissage avec des ressources adaptées et un suivi personnalisé.
                            </p>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-star text-yellow-500"></i>
                            Ce que vous pouvez faire
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-500">
                                <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-comments"></i>
                                    Conversations interactives
                                </h4>
                                <p class="text-blue-700">
                                    Discutez avec notre agent spécialisé pour poser vos questions et obtenir des explications détaillées.
                                </p>
                            </div>
                            <div class="bg-green-50 rounded-xl p-6 border-l-4 border-green-500">
                                <h4 class="font-bold text-green-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-graduation-cap"></i>
                                    Apprentissage personnalisé
                                </h4>
                                <p class="text-green-700">
                                    Recevez des ressources et des exercices adaptés à votre niveau et à vos besoins.
                                </p>
                            </div>
                            <div class="bg-purple-50 rounded-xl p-6 border-l-4 border-purple-500">
                                <h4 class="font-bold text-purple-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-chart-line"></i>
                                    Suivi des progrès
                                </h4>
                                <p class="text-purple-700">
                                    Suivez votre évolution et identifiez les domaines à améliorer avec l'aide de l'IA.
                                </p>
                            </div>
                            <div class="bg-orange-50 rounded-xl p-6 border-l-4 border-orange-500">
                                <h4 class="font-bold text-orange-900 mb-2 flex items-center gap-2">
                                    <i class="fas fa-lightbulb"></i>
                                    Aide aux devoirs
                                </h4>
                                <p class="text-orange-700">
                                    Obtenez de l'aide pour vos devoirs et exercices avec des explications étape par étape.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center space-y-4">
                        <a href="?page=conversation&action=create&subject=<?php echo $subject['id_matiere']; ?>" 
                           class="card-hover inline-block bg-gradient-to-r <?php echo $subjectColor; ?> text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <i class="fas fa-comments mr-3"></i>
                            Démarrer une conversation
                        </a>
                        
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="?page=subject" 
                               class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Retour aux matières
                            </a>
                            
                            <a href="?page=level" 
                               class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-gray-400 transition-all duration-200">
                                <i class="fas fa-layer-group mr-2"></i>
                                Voir les niveaux
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
