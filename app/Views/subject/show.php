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

function getSubjectDescription($subjectName) {
    $name = strtolower($subjectName);
    
    if (strpos($name, 'math') !== false || strpos($name, 'calcul') !== false) {
        return 'Explorez le monde fascinant des mathématiques avec des concepts allant de l\'arithmétique de base aux équations complexes. Notre agent IA vous accompagne pour résoudre des problèmes, comprendre les théorèmes et développer votre logique mathématique.';
    } elseif (strpos($name, 'science') !== false || strpos($name, 'physique') !== false || strpos($name, 'chimie') !== false || strpos($name, 'biologie') !== false) {
        return 'Découvrez les merveilles de la science à travers des expériences interactives et des explications claires. De la physique quantique à la biologie cellulaire, notre agent vous guide dans votre exploration scientifique.';
    } elseif (strpos($name, 'histoire') !== false || strpos($name, 'géographie') !== false || strpos($name, 'geo') !== false) {
        return 'Voyagez à travers le temps et l\'espace pour comprendre notre monde. L\'histoire et la géographie prennent vie avec des récits captivants et des cartes interactives.';
    } elseif (strpos($name, 'littérature') !== false || strpos($name, 'français') !== false || strpos($name, 'lecture') !== false) {
        return 'Plongez dans l\'univers des mots et des idées. Développez votre expression écrite et orale, analysez des œuvres littéraires et enrichissez votre vocabulaire.';
    } elseif (strpos($name, 'anglais') !== false || strpos($name, 'langue') !== false) {
        return 'Maîtrisez une nouvelle langue avec des méthodes interactives et personnalisées. Notre assistant vous accompagne pour améliorer votre grammaire, vocabulaire et expression.';
    } elseif (strpos($name, 'art') !== false || strpos($name, 'dessin') !== false || strpos($name, 'peinture') !== false) {
        return 'Libérez votre créativité à travers diverses formes d\'expression artistique. Apprenez les techniques, découvrez les grands maîtres et développez votre style personnel.';
    } elseif (strpos($name, 'musique') !== false) {
        return 'Explorez l\'art musical sous toutes ses formes. De la théorie musicale à la pratique instrumentale, découvrez l\'harmonie et le rythme qui font battre le cœur de la musique.';
    } elseif (strpos($name, 'sport') !== false || strpos($name, 'eps') !== false) {
        return 'Développez votre condition physique et apprenez l\'importance du sport dans une vie équilibrée. Découvrez différentes disciplines et les valeurs du sport.';
    } elseif (strpos($name, 'informatique') !== false || strpos($name, 'code') !== false || strpos($name, 'programmation') !== false) {
        return 'Entrez dans l\'ère numérique en apprenant la programmation et les technologies modernes. Créez vos premiers programmes et comprenez le monde digital qui nous entoure.';
    } else {
        return 'Une matière passionnante qui vous permettra d\'approfondir vos connaissances et de développer de nouvelles compétences avec l\'aide de notre agent IA spécialisé.';
    }
}
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
        <?php if (!empty($subject)): ?>
            <?php 
                $subjectIcon = getSubjectIconPHP($subject['nom']);
                $subjectColor = getSubjectColorPHP($subject['nom']);
                $subjectDescription = getSubjectDescription($subject['nom']);
            ?>
            
            <!-- Hero Section -->
            <div class="text-center mb-16 animate-slide-up">
                <div class="relative">
                    <!-- Subject Icon -->
                    <div class="w-32 h-32 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 animate-pulse-slow">
                        <i class="<?php echo $subjectIcon; ?> text-white text-5xl"></i>
                    </div>
                    
                    <!-- Subject Title -->
                    <h1 class="text-5xl md:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r <?php echo $subjectColor; ?> bg-clip-text text-transparent">
                            <?php echo htmlspecialchars($subject['nom']); ?>
                        </span>
                    </h1>
                    
                    <!-- Subject Description -->
                    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-8">
                        <?php echo $subjectDescription; ?>
                    </p>
                    
                    <!-- Primary Action Button -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="?page=conversation&action=create&subject=<?php echo $subject['id_matiere']; ?>" 
                           class="bg-gradient-to-r <?php echo $subjectColor; ?> text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-comments text-xl"></i>
                            Commencer l'apprentissage
                        </a>
                        
                        <a href="?page=subject" 
                           class="bg-white border-2 border-gray-200 text-gray-700 px-10 py-4 rounded-2xl font-bold text-lg hover:border-indigo-300 hover:shadow-lg transition-all duration-300 inline-flex items-center gap-3">
                            <i class="fas fa-arrow-left"></i>
                            Toutes les matières
                        </a>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16 animate-fade-in">
                <!-- Feature 1: AI Assistant -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-robot text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Assistant IA Spécialisé</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Un agent intelligent dédié à cette matière pour répondre à toutes vos questions et vous guider dans votre apprentissage.
                        </p>
                    </div>
                </div>

                <!-- Feature 2: Personalized Learning -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-user-graduate text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Apprentissage Personnalisé</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Un parcours adapté à votre niveau et à votre rythme d'apprentissage pour maximiser votre progression.
                        </p>
                    </div>
                </div>

                <!-- Feature 3: Interactive Content -->
                <div class="card-hover bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <i class="fas fa-puzzle-piece text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Contenu Interactif</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Des exercices pratiques, des quiz et des activités engageantes pour rendre l'apprentissage amusant et efficace.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Learning Path Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-12 mb-16 border border-gray-100 animate-fade-in">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-6">
                        <span class="bg-gradient-to-r <?php echo $subjectColor; ?> bg-clip-text text-transparent">
                            Votre Parcours d'Apprentissage
                        </span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Découvrez comment notre agent IA vous accompagne étape par étape dans votre progression.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center relative">
                        <div class="w-20 h-20 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Évaluation Initiale</h3>
                        <p class="text-gray-600">
                            Notre agent évalue votre niveau actuel pour personnaliser votre parcours d'apprentissage.
                        </p>
                        <!-- Connector Line -->
                        <div class="hidden md:block absolute top-10 -right-4 w-8 h-0.5 bg-gradient-to-r <?php echo $subjectColor; ?>"></div>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center relative">
                        <div class="w-20 h-20 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Apprentissage Guidé</h3>
                        <p class="text-gray-600">
                            Apprenez de nouveaux concepts avec des explications claires et des exemples pratiques.
                        </p>
                        <!-- Connector Line -->
                        <div class="hidden md:block absolute top-10 -right-4 w-8 h-0.5 bg-gradient-to-r <?php echo $subjectColor; ?>"></div>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br <?php echo $subjectColor; ?> rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Pratique & Évaluation</h3>
                        <p class="text-gray-600">
                            Mettez en pratique vos connaissances avec des exercices adaptés et suivez vos progrès.
                        </p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Error State -->
            <div class="text-center py-20 animate-slide-up">
                <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Matière introuvable</h3>
                    <p class="text-gray-600 mb-6">
                        Désolé, cette matière n'existe pas ou n'est plus disponible.
                    </p>
                    <a href="?page=subject" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition btn-glow">
                        Voir toutes les matières
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Bottom Navigation -->
        <div class="text-center mt-16">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="?page=subject" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Toutes les matières
                </a>
                
                <a href="?page=level" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                    <i class="fas fa-layer-group mr-2"></i>
                    Voir les niveaux
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