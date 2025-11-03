<?php $pageTitle = 'Connexion'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<div class="max-w-md mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center text-indigo-600">Connexion</h1>

    <form method="POST" action="?page=auth&action=login" class="space-y-6">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="votre@email.com">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
            <i class="fas fa-sign-in-alt"></i> Se connecter
        </button>
    </form>

    <div class="mt-6 text-center text-gray-600">
        <p>Test: alice.dupont@example.com / password1</p>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>