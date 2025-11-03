<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonctions pour les icônes et informations des niveaux
function getLevelInfo($levelName) {
    $name = strtolower($levelName ?? '');
    
    $info = [
        'icon' => 'fas fa-graduation-cap',
        'color' => 'from-indigo-600 to-purple-600',
        'age' => 'Tous âges',
        'description' => 'Un niveau d\'apprentissage adapté à vos besoins'
    ];
    
    if (strpos($name, 'maternelle') !== false || strpos($name, 'petite section') !== false || strpos($name, 'moyenne section') !== false || strpos($name, 'grande section') !== false) {
        $info = [
            'icon' => 'fas fa-baby',
            'color' => 'from-pink-500 to-rose-600',
            'age' => '3-6 ans',
            'description' => 'Découverte du monde et premiers apprentissages en douceur'
        ];
    } elseif (strpos($name, 'cp') !== false || strpos($name, 'ce1') !== false || strpos($name, 'ce2') !== false || strpos($name, 'cm1') !== false || strpos($name, 'cm2') !== false || strpos($name, 'primaire') !== false || strpos($name, 'élémentaire') !== false) {
        $info = [
            'icon' => 'fas fa-child',
            'color' => 'from-green-500 to-emerald-600',
            'age' => '6-11 ans',
            'description' => 'Apprentissage des fondamentaux : lecture, écriture, calcul'
        ];
    } elseif (strpos($name, '6ème') !== false || strpos($name, '5ème') !== false || strpos($name, '4ème') !== false || strpos($name, '3ème') !== false || strpos($name, 'collège') !== false) {
        $info = [
            'icon' => 'fas fa-users',
            'color' => 'from-blue-500 to-indigo-600',
            'age' => '11-15 ans',
            'description' => 'Approfondissement des connaissances et développement de l\'autonomie'
        ];
    } elseif (strpos($name, '2nde') !== false || strpos($name, 'seconde') !== false || strpos($name, '1ère') !== false || strpos($name, 'première') !== false || strpos($name, 'terminale') !== false || strpos($name, 'lycée') !== false) {
        $info = [
            'icon' => 'fas fa-user-graduate',
            'color' => 'from-purple-500 to-violet-600',
            'age' => '15-18 ans',
            'description' => 'Préparation aux études supérieures et spécialisation'
        ];
    } elseif (strpos($name, 'université') !== false || strpos($name, 'supérieur') !== false || strpos($name, 'master') !== false || strpos($name, 'licence') !== false) {
        $info = [
            'icon' => 'fas fa-university',
            'color' => 'from-amber-500 to-orange-600',
            'age' => '18+ ans',
            'description' => 'Études supérieures et formation professionnelle avancée'
        ];
    }
    
    return $info;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niveaux - School Agent</title>
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
                        <a href="?page=level" class="flex items-center gap-2 text-indigo-600 font-semibold">
                            <i class="fas fa-book"></i> Niveaux
                        </a>
                        <a href="?page=subject" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition font-medium">
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
                    <i class="fas fa-layer-group mr-4"></i>
                    Niveaux Éducatifs
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Choisissez votre niveau d'apprentissage pour une expérience personnalisée. 
                Nos agents IA s'adaptent à chaque étape de votre parcours éducatif.
            </p>
        </div>

        <!-- Levels Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
            <?php if (!empty($levels)): ?>
                <?php foreach ($levels as $index => $level): 
                    $levelInfo = getLevelInfo($level['niveau']);
                ?>
                    <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="text-center">
                            <!-- Icon -->
                            <div class="w-20 h-20 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-300">
                                <i class="<?php echo $levelInfo['icon']; ?> text-white text-2xl"></i>
                            </div>
                            
                            <!-- Level Name -->
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                <?php echo htmlspecialchars($level['niveau']); ?>
                            </h3>
                            
                            <!-- Age Range -->
                            <div class="inline-flex items-center gap-2 bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                <i class="fas fa-clock"></i>
                                <?php echo $levelInfo['age']; ?>
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                <?php echo $levelInfo['description']; ?>
                            </p>
                            
                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="?page=level&action=show&id=<?php echo $level['id_niveau_scolaire']; ?>" 
                                   class="block w-full bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                                    <i class="fas fa-eye mr-2"></i>
                                    Découvrir ce niveau
                                </a>
                                
                                <a href="?page=conversation&action=create&level=<?php echo $level['id_niveau_scolaire']; ?>" 
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
                            <i class="fas fa-layer-group text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun niveau disponible</h3>
                        <p class="text-gray-600 mb-6">
                            Les niveaux d'apprentissage seront bientôt disponibles. Revenez plus tard !
                        </p>
                        <a href="?page=home" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition btn-glow">
                            Retourner à l'accueil
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Educational Pathway Section -->
        <div class="bg-white rounded-3xl shadow-2xl p-12 mt-16 border border-gray-100 animate-fade-in">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Votre Parcours Éducatif
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Un apprentissage progressif adapté à chaque étape de votre développement
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <!-- Maternelle -->
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-baby text-white text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Maternelle</h3>
                    <p class="text-sm text-gray-600">3-6 ans</p>
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-8 -right-3 w-6 h-0.5 bg-gradient-to-r from-pink-500 to-green-500"></div>
                </div>

                <!-- Primaire -->
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-child text-white text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Primaire</h3>
                    <p class="text-sm text-gray-600">6-11 ans</p>
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-8 -right-3 w-6 h-0.5 bg-gradient-to-r from-green-500 to-blue-500"></div>
                </div>

                <!-- Collège -->
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Collège</h3>
                    <p class="text-sm text-gray-600">11-15 ans</p>
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-8 -right-3 w-6 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                </div>

                <!-- Lycée -->
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-user-graduate text-white text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Lycée</h3>
                    <p class="text-sm text-gray-600">15-18 ans</p>
                    <!-- Connector Line -->
                    <div class="hidden md:block absolute top-8 -right-3 w-6 h-0.5 bg-gradient-to-r from-purple-500 to-amber-500"></div>
                </div>

                <!-- Supérieur -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-university text-white text-lg"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Supérieur</h3>
                    <p class="text-sm text-gray-600">18+ ans</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="text-center mt-16">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="?page=home" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à l'accueil
                </a>
                
                <a href="?page=subject" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                    <i class="fas fa-bookmark mr-2"></i>
                    Voir les matières
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