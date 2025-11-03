<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonctions pour les icônes et informations des niveaux
function getLevelInfo($levelName) {
    $name = strtolower($levelName);
    
    $info = [
        'icon' => 'fas fa-graduation-cap',
        'color' => 'from-indigo-600 to-purple-600',
        'age' => 'Tous âges',
        'description' => 'Un niveau d\'apprentissage adapté à vos besoins éducatifs.',
        'skills' => ['Apprentissage général', 'Développement personnel'],
        'objectives' => 'Acquérir de nouvelles connaissances et compétences.'
    ];
    
    if (strpos($name, 'maternelle') !== false || strpos($name, 'petite section') !== false || strpos($name, 'moyenne section') !== false || strpos($name, 'grande section') !== false) {
        $info = [
            'icon' => 'fas fa-baby',
            'color' => 'from-pink-500 to-rose-600',
            'age' => '3-6 ans',
            'description' => 'Première étape de la scolarité où l\'enfant découvre le monde qui l\'entoure à travers le jeu et l\'exploration.',
            'skills' => ['Langage oral', 'Motricité fine', 'Socialisation', 'Découverte du monde'],
            'objectives' => 'Développer l\'autonomie, la créativité et les premiers apprentissages en douceur.'
        ];
    } elseif (strpos($name, 'cp') !== false || strpos($name, 'ce1') !== false || strpos($name, 'ce2') !== false || strpos($name, 'cm1') !== false || strpos($name, 'cm2') !== false || strpos($name, 'primaire') !== false || strpos($name, 'élémentaire') !== false) {
        $info = [
            'icon' => 'fas fa-child',
            'color' => 'from-green-500 to-emerald-600',
            'age' => '6-11 ans',
            'description' => 'Apprentissage des compétences fondamentales : lire, écrire, compter. Base solide pour tous les apprentissages futurs.',
            'skills' => ['Lecture et écriture', 'Mathématiques de base', 'Sciences naturelles', 'Histoire-géographie'],
            'objectives' => 'Maîtriser les savoirs fondamentaux et développer l\'esprit critique.'
        ];
    } elseif (strpos($name, '6ème') !== false || strpos($name, '5ème') !== false || strpos($name, '4ème') !== false || strpos($name, '3ème') !== false || strpos($name, 'collège') !== false) {
        $info = [
            'icon' => 'fas fa-users',
            'color' => 'from-blue-500 to-indigo-600',
            'age' => '11-15 ans',
            'description' => 'Approfondissement des connaissances avec l\'introduction de nouvelles matières et le développement de l\'autonomie.',
            'skills' => ['Langues vivantes', 'Sciences physiques', 'Mathématiques avancées', 'Littérature'],
            'objectives' => 'Consolider les acquis et préparer l\'orientation vers le lycée.'
        ];
    } elseif (strpos($name, '2nde') !== false || strpos($name, 'seconde') !== false || strpos($name, '1ère') !== false || strpos($name, 'première') !== false || strpos($name, 'terminale') !== false || strpos($name, 'lycée') !== false) {
        $info = [
            'icon' => 'fas fa-user-graduate',
            'color' => 'from-purple-500 to-violet-600',
            'age' => '15-18 ans',
            'description' => 'Préparation aux études supérieures avec une spécialisation progressive selon les filières choisies.',
            'skills' => ['Spécialisations', 'Philosophie', 'Méthodologie', 'Préparation aux examens'],
            'objectives' => 'Obtenir le baccalauréat et préparer l\'entrée dans l\'enseignement supérieur.'
        ];
    } elseif (strpos($name, 'université') !== false || strpos($name, 'supérieur') !== false || strpos($name, 'master') !== false || strpos($name, 'licence') !== false) {
        $info = [
            'icon' => 'fas fa-university',
            'color' => 'from-amber-500 to-orange-600',
            'age' => '18+ ans',
            'description' => 'Formation spécialisée et recherche approfondie dans un domaine d\'expertise choisi.',
            'skills' => ['Recherche', 'Expertise métier', 'Projets avancés', 'Innovation'],
            'objectives' => 'Devenir expert dans son domaine et préparer l\'insertion professionnelle.'
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
    <title><?php echo htmlspecialchars($level['nom'] ?? 'Niveau'); ?> - School Agent</title>
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
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .animate-pulse-slow {
            animation: pulse 3s ease-in-out infinite;
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
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 15s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape w-20 h-20 bg-indigo-400 rounded-full top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="shape w-32 h-32 bg-purple-400 rounded-full top-1/3 right-10" style="animation-delay: 5s;"></div>
        <div class="shape w-24 h-24 bg-pink-400 rounded-full bottom-20 left-1/4" style="animation-delay: 10s;"></div>
    </div>

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
        <?php if (!empty($level)): ?>
            <?php 
                $levelInfo = getLevelInfo($level['nom']);
            ?>
            
            <!-- Hero Section -->
            <div class="text-center mb-16 animate-slide-up">
                <div class="relative">
                    <!-- Level Icon -->
                    <div class="w-32 h-32 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 animate-pulse-slow">
                        <i class="<?php echo $levelInfo['icon']; ?> text-white text-5xl"></i>
                    </div>
                    
                    <!-- Level Title -->
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">
                        <span class="bg-gradient-to-r <?php echo $levelInfo['color']; ?> bg-clip-text text-transparent">
                            <?php echo htmlspecialchars($level['nom']); ?>
                        </span>
                    </h1>
                    
                    <!-- Age Range -->
                    <div class="inline-flex items-center gap-3 bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-8 py-3 rounded-full text-lg font-bold mb-6 shadow-lg">
                        <i class="fas fa-clock"></i>
                        <?php echo $levelInfo['age']; ?>
                    </div>
                    
                    <!-- Level Description -->
                    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-8">
                        <?php echo $levelInfo['description']; ?>
                    </p>
                    
                    <!-- Primary Action Button -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="?page=conversation&action=create&level=<?php echo $level['id_niveau']; ?>" 
                           class="bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-comments text-xl"></i>
                            Commencer l'apprentissage
                        </a>
                        
                        <a href="?page=level" 
                           class="bg-white border-2 border-gray-200 text-gray-700 px-10 py-4 rounded-2xl font-bold text-lg hover:border-indigo-300 hover:shadow-lg transition-all duration-300 inline-flex items-center gap-3">
                            <i class="fas fa-arrow-left"></i>
                            Tous les niveaux
                        </a>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 animate-fade-in">
                <!-- Compétences développées -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Compétences développées</h3>
                            <p class="text-gray-600">Les apprentissages essentiels de ce niveau</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <?php foreach ($levelInfo['skills'] as $skill): ?>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                <div class="w-8 h-8 bg-gradient-to-br <?php echo $levelInfo['color']; ?> rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <span class="text-gray-800 font-medium"><?php echo htmlspecialchars($skill); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Objectifs pédagogiques -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-target text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Objectifs pédagogiques</h3>
                            <p class="text-gray-600">Ce que vous allez accomplir</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 leading-relaxed text-lg">
                        <?php echo $levelInfo['objectives']; ?>
                    </p>
                    
                    <div class="mt-6 p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-lightbulb text-emerald-600 text-xl"></i>
                            <p class="text-emerald-800 font-medium">
                                Notre IA s'adapte automatiquement à votre niveau pour une progression optimale.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Learning Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 animate-fade-in">
                <!-- Feature 1: Personnalisation -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-user-cog text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Apprentissage Personnalisé</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Contenu adapté à votre niveau et à votre rythme d'apprentissage pour maximiser votre progression.
                        </p>
                    </div>
                </div>

                <!-- Feature 2: Suivi des progrès -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Suivi des Progrès</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Visualisez votre progression en temps réel et identifiez les domaines à améliorer.
                        </p>
                    </div>
                </div>

                <!-- Feature 3: Ressources adaptées -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-book-open text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Ressources Adaptées</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Exercices, cours et activités spécialement conçus pour votre niveau d'études.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Call to Action Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-12 mb-16 border border-gray-100 text-center animate-fade-in">
                <h2 class="text-4xl font-bold mb-6">
                    <span class="bg-gradient-to-r <?php echo $levelInfo['color']; ?> bg-clip-text text-transparent">
                        Prêt à commencer votre apprentissage ?
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                    Rejoignez des milliers d'étudiants qui progressent chaque jour avec nos agents IA spécialisés.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="?page=conversation&action=create&level=<?php echo $level['id_niveau']; ?>" 
                       class="bg-gradient-to-r <?php echo $levelInfo['color']; ?> text-white px-12 py-4 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                        <i class="fas fa-rocket"></i>
                        Démarrer maintenant
                    </a>
                    
                    <a href="?page=subject" 
                       class="bg-white border-2 border-gray-200 text-gray-700 px-12 py-4 rounded-2xl font-bold text-xl hover:border-indigo-300 hover:shadow-lg transition-all duration-300 inline-flex items-center gap-3">
                        <i class="fas fa-bookmark"></i>
                        Explorer les matières
                    </a>
                </div>
            </div>

        <?php else: ?>
            <!-- Error State -->
            <div class="text-center py-20 animate-slide-up">
                <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Niveau introuvable</h3>
                    <p class="text-gray-600 mb-6">
                        Désolé, ce niveau n'existe pas ou n'est plus disponible.
                    </p>
                    <a href="?page=level" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition btn-glow">
                        Voir tous les niveaux
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Bottom Navigation -->
        <div class="text-center mt-16">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="?page=level" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Tous les niveaux
                </a>
                
                <a href="?page=subject" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                    <i class="fas fa-bookmark mr-2"></i>
                    Voir les matières
                </a>
                
                <a href="?page=home" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                    <i class="fas fa-home mr-2"></i>
                    Accueil
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