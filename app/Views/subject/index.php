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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matières - School Agent</title>
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
        .subject-card {
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
                    <i class="fas fa-book-open mr-4"></i>
                    Matières Scolaires
                </h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto">
                    Découvrez toutes les matières disponibles et explorez les agents spécialisés pour chaque domaine d'apprentissage
                </p>
            </div>

            <!-- Subjects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($subjects)): ?>
                    <?php foreach ($subjects as $subject): 
                        $subjectIcon = getSubjectIconPHP($subject['nom']);
                        $subjectColor = getSubjectColorPHP($subject['nom']);
                    ?>
                        <div class="card-hover subject-card">
                            <div class="text-center">
                                <!-- Icon -->
                                <div class="w-20 h-20 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <i class="<?php echo $subjectIcon; ?> text-white text-2xl"></i>
                                </div>
                                
                                <!-- Subject Name -->
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                    <?php echo htmlspecialchars($subject['nom']); ?>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    Explorez cette matière avec notre agent spécialisé et découvrez des ressources adaptées à votre niveau.
                                </p>
                                
                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    <a href="?page=subject&action=show&id=<?php echo $subject['id_matiere']; ?>" 
                                       class="block w-full bg-gradient-to-r <?php echo $subjectColor; ?> text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                                        <i class="fas fa-eye mr-2"></i>
                                        Voir les détails
                                    </a>
                                    
                                    <a href="?page=conversation&action=create&subject=<?php echo $subject['id_matiere']; ?>" 
                                       class="block w-full bg-white border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-gray-400 hover:shadow-md transition-all duration-200">
                                        <i class="fas fa-comments mr-2"></i>
                                        Démarrer une conversation
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-16">
                        <div class="subject-card max-w-md mx-auto">
                            <i class="fas fa-book text-6xl text-gray-400 mb-6"></i>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune matière disponible</h3>
                            <p class="text-gray-600">
                                Les matières scolaires seront bientôt disponibles. Revenez plus tard !
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <div class="text-center mt-12">
                <a href="?page=home" class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>