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
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="?page=home" class="flex items-center gap-2 text-2xl font-bold text-indigo-600">
                <i class="fas fa-graduation-cap"></i>
                <span>School Agent</span>
            </a>
            
            <div class="flex items-center gap-6">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <a href="?page=conversation" class="hover:text-indigo-600 transition">
                        <i class="fas fa-comments"></i> Conversations
                    </a>
                    <a href="?page=level" class="hover:text-indigo-600 transition">
                        <i class="fas fa-book"></i> Niveaux
                    </a>
                    <a href="?page=subject" class="hover:text-indigo-600 transition">
                        <i class="fas fa-bookmark"></i> Matières
                    </a>
                    <div class="flex items-center gap-3 pl-6 border-l border-gray-300">
                        <span class="text-sm text-gray-700">
                            <i class="fas fa-user-circle"></i> 
                            <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?>
                        </span>
                        <a href="?page=logout" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                <?php else: ?>
                    <a href="?page=login" class="text-gray-700 hover:text-indigo-600 transition">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </a>
                    <a href="#" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-user-plus"></i> Créer un compte
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']): ?>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-24">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">Bienvenue sur School Agent</h1>
            <p class="text-xl mb-12 max-w-2xl mx-auto text-indigo-100">
                Votre assistant IA pour l'apprentissage personnalisé. Découvrez nos agents spécialisés qui vous accompagnent dans vos études avec intelligence et bienveillance.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="?page=login" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
                <a href="#" class="bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-800 transition inline-block border-2 border-white">
                    <i class="fas fa-user-plus"></i> Créer un compte
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">Pourquoi choisir School Agent ?</h2>
            <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">
                Nos agents IA spécialisés vous offrent un accompagnement personnalisé pour réussir vos études.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-indigo-600 mb-4"><i class="fas fa-brain"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">IA Spécialisée</h3>
                    <p class="text-gray-600">
                        Chaque agent est expert dans sa matière : mathématiques, histoire, sciences... Un accompagnement adapté à chaque discipline.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-purple-600 mb-4"><i class="fas fa-chart-line"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Suivi Personnalisé</h3>
                    <p class="text-gray-600">
                        Progression adaptée à votre niveau et à votre rythme. L'IA s'adapte à vos forces et vous aide à surmonter vos difficultés.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-green-600 mb-4"><i class="fas fa-shield-alt"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">100% Sécurisé</h3>
                    <p class="text-gray-600">
                        Vos données sont protégées et votre vie privée respectée. Conformité RGPD et sécurité maximale garanties.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-blue-600 mb-4"><i class="fas fa-clock"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">24h/24</h3>
                    <p class="text-gray-600">
                        Votre assistant personnel est toujours disponible. Posez vos questions à tout moment, obtenez des réponses instantanées.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-pink-600 mb-4"><i class="fas fa-comments"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Conversations Naturelles</h3>
                    <p class="text-gray-600">
                        Échangez naturellement avec nos agents. Ils comprennent vos questions et s'adaptent à votre style d'apprentissage.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl text-yellow-600 mb-4"><i class="fas fa-graduation-cap"></i></div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Tous Niveaux</h3>
                    <p class="text-gray-600">
                        Du collège à l'université, nos agents s'adaptent à votre niveau scolaire pour un accompagnement optimal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Prêt à commencer votre apprentissage ?</h2>
            <a href="#" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                <i class="fas fa-rocket"></i> Créer votre compte gratuitement
            </a>
        </div>
    </section>

    <?php else: ?>
    <!-- Dashboard for logged-in users -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-indigo-600">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Conversations Card -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 text-white p-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <div class="text-4xl mb-4"><i class="fas fa-comments"></i></div>
                <h2 class="text-2xl font-bold mb-2">Conversations</h2>
                <p class="mb-4">Gérez vos conversations avec les agents IA</p>
                <a href="?page=conversation" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                    Voir plus →
                </a>
            </div>

            <!-- Levels Card -->
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 text-white p-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <div class="text-4xl mb-4"><i class="fas fa-book"></i></div>
                <h2 class="text-2xl font-bold mb-2">Niveaux Scolaires</h2>
                <p class="mb-4">Explorez les différents niveaux d'éducation</p>
                <a href="?page=level" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-semibold hover:bg-purple-50 transition">
                    Voir plus →
                </a>
            </div>

            <!-- Subjects Card -->
            <div class="bg-gradient-to-br from-pink-400 to-pink-600 text-white p-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <div class="text-4xl mb-4"><i class="fas fa-bookmark"></i></div>
                <h2 class="text-2xl font-bold mb-2">Matières</h2>
                <p class="mb-4">Découvrez toutes les matières disponibles</p>
                <a href="?page=subject" class="bg-white text-pink-600 px-6 py-2 rounded-lg font-semibold hover:bg-pink-50 transition">
                    Voir plus →
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- About -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                        <i class="fas fa-graduation-cap"></i> School Agent
                    </h3>
                    <p class="text-sm">Assistant IA pour l'apprentissage et l'accompagnement scolaire personnalisé.</p>
                    <p class="text-sm mt-4">Développé avec ❤️ par Olivier / Nicolas / Flavie</p>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-white font-bold mb-4">📚 Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="?page=conversation" class="hover:text-white transition">Conversations IA</a></li>
                        <li><a href="?page=subject" class="hover:text-white transition">Matières</a></li>
                        <li><a href="?page=level" class="hover:text-white transition">Niveaux scolaires</a></li>
                        <li><a href="?page=user" class="hover:text-white transition">Gestion utilisateurs</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-white font-bold mb-4">🔒 Confidentialité & Légal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white transition">Gestion des cookies</a></li>
                        <li><a href="#" class="hover:text-white transition">Mes données (RGPD)</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-white font-bold mb-4">📞 Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Support technique</a></li>
                        <li><a href="#" class="hover:text-white transition">Délégué à la protection des données</a></li>
                        <li><a href="#" class="hover:text-white transition">CNIL - Vos droits</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm">
                <p>&copy; 2024 School Agent. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>