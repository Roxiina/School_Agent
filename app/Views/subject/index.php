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
        * {
            scroll-behavior: smooth;
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.2);
        }
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .btn-glow:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-50 border-b border-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="?page=home" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">School Agent</span>
                </a>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <a href="?page=conversation" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition font-medium">
                            <i class="fas fa-comments"></i> Conversations
                        </a>
                        <a href="?page=level" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition font-medium">
                            <i class="fas fa-book"></i> Niveaux
                        </a>
                        <a href="?page=subject" class="flex items-center gap-2 text-indigo-600 font-semibold">
                            <i class="fas fa-bookmark"></i> Matières
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?></p>
                                <p class="text-xs text-gray-500"><?php echo htmlspecialchars($_SESSION['user_email'] ?? 'email@example.com'); ?></p>
                            </div>
                            <a href="?page=logout" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold btn-glow">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="?page=login" class="text-gray-700 hover:text-indigo-600 transition font-medium flex items-center gap-2">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="text-center mb-16 animate-slide-up">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                    <i class="fas fa-book-open mr-4"></i>
                    Matières Scolaires
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Découvrez toutes les matières disponibles et explorez les agents spécialisés pour chaque domaine d'apprentissage. 
                Chaque matière dispose d'un assistant IA dédié pour vous accompagner.
            </p>
        </div>

        <!-- Subjects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
            <?php if (!empty($subjects)): ?>
                <?php foreach ($subjects as $index => $subject): 
                    $subjectIcon = getSubjectIconPHP($subject['nom']);
                    $subjectColor = getSubjectColorPHP($subject['nom']);
                ?>
                    <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="text-center">
                            <!-- Icon -->
                            <div class="w-20 h-20 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-300">
                                <i class="<?php echo $subjectIcon; ?> text-white text-2xl"></i>
                            </div>
                            
                            <!-- Subject Name -->
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                <?php echo htmlspecialchars($subject['nom']); ?>
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Explorez cette matière avec notre agent spécialisé et découvrez des ressources adaptées à votre niveau d'apprentissage.
                            </p>
                            
                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="?page=subject&action=show&id=<?php echo $subject['id_matiere']; ?>" 
                                   class="block w-full bg-gradient-to-r <?php echo $subjectColor; ?> text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                                    <i class="fas fa-eye mr-2"></i>
                                    Découvrir la matière
                                </a>
                                
                                <a href="?page=conversation&action=create&subject=<?php echo $subject['id_matiere']; ?>" 
                                   class="block w-full bg-white border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                                    <i class="fas fa-comments mr-2"></i>
                                    Commencer à apprendre
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20">
                    <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune matière disponible</h3>
                        <p class="text-gray-600 mb-6">
                            Les matières scolaires seront bientôt disponibles. Revenez plus tard !
                        </p>
                        <a href="?page=home" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition btn-glow">
                            Retourner à l'accueil
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <div class="text-center mt-16">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="?page=home" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à l'accueil
                </a>
                
                <a href="?page=level" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                    <i class="fas fa-layer-group mr-2"></i>
                    Voir les niveaux
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">School Agent</span>
                </div>
                <p class="text-gray-600">© 2025 School Agent. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>