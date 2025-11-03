<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Agent - Assistant IA pour l'apprentissage</title>
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
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(79, 70, 229, 0.5); }
            50% { box-shadow: 0 0 40px rgba(147, 51, 234, 0.8); }
        }
        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.2);
        }
        .feature-icon {
            transition: all 0.4s ease;
        }
        .card-hover:hover .feature-icon {
            transform: scale(1.2) rotate(5deg);
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
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
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
                        <a href="#" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold btn-glow">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']): ?>
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-32 px-4">
            <!-- Animated Background -->
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-20 left-10 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                <div class="absolute top-40 right-10 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            </div>

            <div class="max-w-7xl mx-auto text-center animate-slide-up">
                <h1 class="text-6xl md:text-7xl font-bold mb-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Votre Assistant IA<br>pour l'Apprentissage
                </h1>
                <p class="text-xl md:text-2xl text-gray-700 mb-12 max-w-3xl mx-auto leading-relaxed font-light">
                    Découvrez une nouvelle façon d'apprendre avec nos agents IA spécialisés. Un accompagnement personnalisé, intelligent et bienveillant, disponible 24h/24.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="?page=login" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 btn-glow pulse-glow">
                        <i class="fas fa-rocket mr-2"></i> Commencer Maintenant
                    </a>
                    <a href="#features" class="border-2 border-indigo-600 text-indigo-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-50 transition">
                        <i class="fas fa-arrow-down mr-2"></i> Découvrir Plus
                    </a>
                </div>

                <!-- Floating Stats -->
                <div class="grid grid-cols-3 gap-4 mt-20 max-w-2xl mx-auto">
                    <div class="bg-white/60 backdrop-blur-xl p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold text-indigo-600">500+</div>
                        <div class="text-sm text-gray-600 mt-2">Étudiants</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-xl p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold text-purple-600">6+</div>
                        <div class="text-sm text-gray-600 mt-2">Matières</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-xl p-6 rounded-xl shadow-lg">
                        <div class="text-3xl font-bold text-pink-600">10k+</div>
                        <div class="text-sm text-gray-600 mt-2">Questions</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-32 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-5xl md:text-6xl font-bold mb-6 text-gray-900">Pourquoi choisir School Agent ?</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Des agents IA spécialisés pour accompagner votre réussite</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-indigo-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-indigo-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-brain text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">IA Spécialisée</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Chaque agent maîtrise parfaitement sa discipline. Un vrai expert dans sa matière pour vous guider efficacement.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-purple-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">Suivi Personnalisé</h3>
                        <p class="text-gray-600 leading-relaxed">
                            L'IA s'adapte à votre rythme et vos forces. Progression vraiment personnalisée, pas du contenu générique.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-green-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">100% Sécurisé</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Vos données sont protégées avec le plus haut niveau de sécurité. Conformité RGPD garantie.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-blue-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">Disponible 24h/24</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Pas de limite horaire. Vos questions sont répondues à tout moment, même à minuit ou le week-end.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-pink-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-600 to-pink-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-comments text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">Conversations Naturelles</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Échangez comme avec un vrai prof. L'IA comprend le contexte et s'adapte à votre style.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="card-hover bg-white p-8 rounded-2xl shadow-lg border border-yellow-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-600 to-yellow-400 rounded-xl flex items-center justify-center mb-6 feature-icon">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">Tous Niveaux</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Du collège à l'université. Nos agents couvrent tous les niveaux scolaires avec expertise.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-24 px-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="text-5xl md:text-6xl font-bold mb-8 text-white">
                    Prêt à Commencer ?
                </h2>
                <p class="text-xl text-white/90 mb-12">
                    Créez votre compte gratuitement et débloquez l'accès à nos agents IA spécialisés
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="?page=login" class="bg-white text-indigo-600 px-10 py-4 rounded-xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 btn-glow">
                        <i class="fas fa-play-circle mr-2"></i> Commencer
                    </a>
                    <a href="#" class="border-2 border-white text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition">
                        <i class="fas fa-info-circle mr-2"></i> En Savoir Plus
                    </a>
                </div>
            </div>
        </section>

    <?php else: ?>
        <!-- Dashboard for logged-in users -->
        <section class="py-12 px-4">
            <div class="max-w-7xl mx-auto">
                <!-- Welcome & Header -->
                <div class="mb-12">
                    <h1 class="text-5xl md:text-6xl font-bold mb-4 text-gray-900">
                        Bienvenue, <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span> 👋
                    </h1>
                    <p class="text-xl text-gray-600">Continuez votre apprentissage avec nos agents spécialisés</p>
                </div>

                <!-- Quick Actions (En haut pour meilleure visibilité) -->
                <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-indigo-100 mb-12">
                    <h3 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                        <i class="fas fa-lightning-bolt text-yellow-500"></i> Accès Rapide
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        <a href="?page=conversation" class="card-hover bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 p-6 rounded-xl text-center hover:shadow-lg hover:border-blue-600 transition group">
                            <div class="bg-blue-600 text-white w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <i class="fas fa-comments text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Conversations</h4>
                            <p class="text-xs text-gray-600">Mes discussions</p>
                        </a>

                        <a href="?page=subject" class="card-hover bg-gradient-to-br from-pink-50 to-pink-100 border-2 border-pink-200 p-6 rounded-xl text-center hover:shadow-lg hover:border-pink-600 transition group">
                            <div class="bg-pink-600 text-white w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <i class="fas fa-bookmark text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Matières</h4>
                            <p class="text-xs text-gray-600">Explorez les matières</p>
                        </a>

                        <a href="?page=level" class="card-hover bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 p-6 rounded-xl text-center hover:shadow-lg hover:border-purple-600 transition group">
                            <div class="bg-purple-600 text-white w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <i class="fas fa-book text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Niveaux</h4>
                            <p class="text-xs text-gray-600">Voir les niveaux</p>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Profile Card (Sidebar) -->
                    <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-indigo-100 h-fit">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                            <i class="fas fa-user text-indigo-600"></i> Mon Profil
                        </h2>

                        <div class="space-y-6">
                            <!-- Prénom -->
                            <div>
                                <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Prénom</label>
                                <p class="text-lg font-bold text-gray-900 mt-1"><?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></p>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Email</label>
                                <p class="text-sm text-indigo-600 font-semibold mt-1 break-all"><?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?></p>
                            </div>

                            <!-- Niveau Scolaire -->
                            <div>
                                <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Niveau</label>
                                <div class="mt-2">
                                    <span class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-full font-bold text-sm">
                                        <i class="fas fa-book mr-2"></i>Collège
                                    </span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="flex gap-3 text-sm text-gray-600 pt-2">
                                <span class="flex items-center gap-1"><i class="fas fa-check-circle text-green-600"></i> Actif</span>
                                <span class="flex items-center gap-1"><i class="fas fa-calendar text-gray-500"></i> Aujourd'hui</span>
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-gray-200 pt-6">
                                <a href="?page=user" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-3 rounded-xl hover:shadow-lg transition font-bold text-center text-sm block">
                                    <i class="fas fa-user-circle mr-2"></i> Voir mon profil complet
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Mes Conversations -->
                        <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-indigo-100">
                            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                                <i class="fas fa-comments text-purple-600"></i> Mes Dernières Conversations
                            </h2>

                            <div class="space-y-4">
                                <!-- Conversation 1 -->
                                <div class="border-l-4 border-indigo-600 bg-gradient-to-r from-indigo-50 to-transparent p-5 rounded-lg hover:shadow-md transition cursor-pointer">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-gray-900">💬 Ouvrir le chat</h3>
                                            <p class="text-gray-600 text-xs mt-1">Agent : <strong>Agent Scolaire</strong></p>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded">03/11 10:42</span>
                                    </div>
                                </div>

                                <!-- Conversation 2 -->
                                <div class="border-l-4 border-purple-600 bg-gradient-to-r from-purple-50 to-transparent p-5 rounded-lg hover:shadow-md transition cursor-pointer">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-gray-900">Révision des équations</h3>
                                            <p class="text-gray-600 text-xs mt-1">Agent : <strong>Agent Mathéo</strong></p>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded">03/11 10:21</span>
                                    </div>
                                </div>

                                <!-- Conversation 3 -->
                                <div class="border-l-4 border-pink-600 bg-gradient-to-r from-pink-50 to-transparent p-5 rounded-lg hover:shadow-md transition cursor-pointer">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-gray-900">⚔️ Guerre mondiale</h3>
                                            <p class="text-gray-600 text-xs mt-1">Agent : <strong>Agent Histoire</strong></p>
                                        </div>
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded">03/11 09:59</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <a href="?page=conversation" class="text-indigo-600 hover:text-indigo-700 font-bold transition text-sm">
                                    <i class="fas fa-arrow-right mr-2"></i>Voir toutes les conversations →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agents par Matière Section -->
                <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-indigo-100">
                    <h2 class="text-3xl font-bold mb-8 text-gray-900 flex items-center gap-2">
                        <i class="fas fa-robot text-pink-600"></i> Agents par Matière
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Agent Histoire -->
                        <div class="border border-pink-200 p-6 rounded-xl hover:border-pink-600 hover:shadow-lg transition">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-600 to-pink-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-scroll text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Histoire</h3>
                                    <p class="text-xs text-gray-600">Agent Histoire</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Agent passionné d'histoire et de culture générale...</p>
                            <button class="w-full bg-gradient-to-r from-pink-600 to-pink-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <i class="fas fa-comments mr-2"></i> Discuter
                            </button>
                        </div>

                        <!-- Agent Mathématiques -->
                        <div class="border border-purple-200 p-6 rounded-xl hover:border-purple-600 hover:shadow-lg transition">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calculator text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Mathématiques</h3>
                                    <p class="text-xs text-gray-600">Agent Mathéo</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Agent spécialisé en mathématiques et résolution de problèmes...</p>
                            <button class="w-full bg-gradient-to-r from-purple-600 to-purple-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <i class="fas fa-comments mr-2"></i> Discuter
                            </button>
                        </div>

                        <!-- Agent Méthodologie -->
                        <div class="border border-indigo-200 p-6 rounded-xl hover:border-indigo-600 hover:shadow-lg transition">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-indigo-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-brain text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Méthodologie</h3>
                                    <p class="text-xs text-gray-600">Agent Scolaire</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Agent généraliste pour le suivi scolaire...</p>
                            <button class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <i class="fas fa-comments mr-2"></i> Discuter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 text-gray-300 mt-20 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-400 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-400 rounded-full filter blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-24 relative z-10">
            <!-- Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-2xl">School Agent</h3>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400">
                        L'assistant IA pour l'apprentissage personnalisé. Réussissez vos études avec intelligence et bienveillance.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <i class="fas fa-rocket text-indigo-400"></i> Accès Rapide
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="?page=conversation" class="hover:text-indigo-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Conversations</a></li>
                        <li><a href="?page=subject" class="hover:text-indigo-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Matières</a></li>
                        <li><a href="?page=level" class="hover:text-indigo-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Niveaux</a></li>
                        <li><a href="?page=user" class="hover:text-indigo-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Profil</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <i class="fas fa-book text-purple-400"></i> Ressources
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-purple-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Documentation</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Guide d'utilisation</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> FAQ</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Support</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <i class="fas fa-shield text-pink-400"></i> Légal
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-pink-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Confidentialité</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Conditions</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> RGPD</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition duration-300 flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Cookies</a></li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-indigo-800/50"></div>

            <!-- Bottom Section -->
            <div class="pt-12 mt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="text-sm text-gray-400">
                        &copy; 2024 School Agent. Tous droits réservés.
                    </div>
                    <div class="text-center">
                        <div class="flex justify-center gap-4">
                            <a href="#" class="w-10 h-10 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition flex items-center justify-center">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-purple-600 hover:bg-purple-700 transition flex items-center justify-center">
                                <i class="fab fa-twitter text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-lg bg-pink-600 hover:bg-pink-700 transition flex items-center justify-center">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-right text-sm font-semibold text-indigo-400">
                        Développé avec ❤️ par Olivier / Nicolas / Flavie
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>