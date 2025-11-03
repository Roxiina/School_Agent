<?php $pageTitle = 'Accueil - School Agent'; require __DIR__ . '/templates/header_tailwind.php'; ?>

<h1 class="text-4xl font-bold mb-8 text-indigo-600">Bienvenue à School Agent 👋</h1>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
    <p class="text-xl text-gray-700 mb-12">Bonjour <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong> !</p>
    
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

    <div class="mt-12 bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
        <h3 class="text-xl font-bold text-blue-900 mb-2">💡 Astuce</h3>
        <p class="text-blue-800">Utilisez la navigation pour explorer les conversations, les niveaux et les matières disponibles sur la plateforme.</p>
    </div>
<?php else: ?>
    <div class="text-center py-12">
        <p class="text-2xl text-gray-700 mb-8">Bienvenue sur School Agent !</p>
        <p class="text-gray-600 mb-12 max-w-2xl">Connectez-vous pour accéder à la plateforme d'apprentissage intelligente.</p>
        <a href="?page=login" class="bg-indigo-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition">
            Se connecter →
        </a>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/templates/footer_tailwind.php'; ?>