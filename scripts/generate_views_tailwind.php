<?php

$viewsDir = __DIR__ . '/../app/Views';

// Home page
$home = <<<'EOT'
<?php $pageTitle = 'Accueil - School Agent'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

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

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/home.php', $home);

// Login page
$login = <<<'EOT'
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
EOT;

file_put_contents($viewsDir . '/auth/login.php', $login);

// Conversation Index
$convIndex = <<<'EOT'
<?php $pageTitle = 'Conversations'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-indigo-600">💬 Mes Conversations</h1>
    <a href="?page=conversation&action=create" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
        <i class="fas fa-plus"></i> Nouvelle
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php if (!empty($conversations)): ?>
        <?php foreach ($conversations as $conv): ?>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border-l-4 border-indigo-500">
                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($conv['titre']); ?></h3>
                <p class="text-gray-600 mb-4 text-sm"><?php echo htmlspecialchars(substr($conv['description'] ?? '', 0, 100)); ?>...</p>
                <div class="flex gap-2">
                    <a href="?page=conversation&action=show&id=<?php echo $conv['id_conversation']; ?>" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition text-center">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="?page=conversation&action=edit&id=<?php echo $conv['id_conversation']; ?>" class="flex-1 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition text-center">
                        <i class="fas fa-edit"></i> Éditer
                    </a>
                    <a href="?page=conversation&action=delete&id=<?php echo $conv['id_conversation']; ?>" onclick="return confirm('Êtes-vous sûr ?')" class="flex-1 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition text-center">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-2 text-center py-12">
            <p class="text-gray-500 text-lg">Aucune conversation trouvée.</p>
            <a href="?page=conversation&action=create" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Créer une conversation
            </a>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/index.php', $convIndex);

// Conversation Show
$convShow = <<<'EOT'
<?php $pageTitle = 'Conversation - ' . htmlspecialchars($conversation['titre'] ?? 'Détail'); require __DIR__ . '/../templates/header_tailwind.php'; ?>

<div class="mb-8">
    <a href="?page=conversation" class="text-indigo-600 hover:text-indigo-700">← Retour aux conversations</a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold text-indigo-600 mb-2"><?php echo htmlspecialchars($conversation['titre']); ?></h1>
    <p class="text-gray-600 mb-8"><?php echo htmlspecialchars($conversation['description'] ?? ''); ?></p>

    <div class="border-t pt-6">
        <h2 class="text-2xl font-bold mb-6">Messages</h2>
        
        <?php if (!empty($messages)): ?>
            <div class="space-y-4 mb-8">
                <?php foreach ($messages as $msg): ?>
                    <div class="bg-gray-50 p-4 rounded border-l-4 border-indigo-500">
                        <p class="text-gray-800"><?php echo htmlspecialchars($msg['contenu']); ?></p>
                        <small class="text-gray-500"><?php echo htmlspecialchars($msg['date_creation']); ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center py-8">Aucun message dans cette conversation.</p>
        <?php endif; ?>

        <div class="flex gap-2 mt-6">
            <a href="?page=conversation&action=edit&id=<?php echo $conversation['id_conversation']; ?>" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">
                <i class="fas fa-edit"></i> Éditer
            </a>
            <a href="?page=conversation&action=delete&id=<?php echo $conversation['id_conversation']; ?>" onclick="return confirm('Êtes-vous sûr ?')" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 transition">
                <i class="fas fa-trash"></i> Supprimer
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/show.php', $convShow);

// Levels Index
$levelIndex = <<<'EOT'
<?php $pageTitle = 'Niveaux Scolaires'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<h1 class="text-3xl font-bold text-indigo-600 mb-8">📚 Niveaux Scolaires</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($levels)): ?>
        <?php foreach ($levels as $level): ?>
            <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                <h3 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($level['nom_niveau']); ?></h3>
                <a href="?page=level&action=show&id=<?php echo $level['id_niveau_scolaire']; ?>" class="inline-block bg-white text-indigo-600 px-6 py-2 rounded font-semibold hover:bg-indigo-50 transition">
                    <i class="fas fa-arrow-right"></i> Détails
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">Aucun niveau trouvé.</p>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/level/index.php', $levelIndex);

// Subjects Index
$subjectIndex = <<<'EOT'
<?php $pageTitle = 'Matières'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<h1 class="text-3xl font-bold text-indigo-600 mb-8">📖 Matières</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (!empty($subjects)): ?>
        <?php foreach ($subjects as $subject): ?>
            <div class="bg-gradient-to-br from-pink-400 to-pink-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                <h3 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($subject['nom_matiere']); ?></h3>
                <a href="?page=subject&action=show&id=<?php echo $subject['id_matiere']; ?>" class="inline-block bg-white text-pink-600 px-6 py-2 rounded font-semibold hover:bg-pink-50 transition">
                    <i class="fas fa-arrow-right"></i> Détails
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">Aucune matière trouvée.</p>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/subject/index.php', $subjectIndex);

// Users Index
$userIndex = <<<'EOT'
<?php $pageTitle = 'Utilisateurs'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<h1 class="text-3xl font-bold text-indigo-600 mb-8">👥 Utilisateurs</h1>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left">Nom</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Rôle</th>
                <th class="px-6 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="px-6 py-4"><span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm"><?php echo htmlspecialchars($user['role']); ?></span></td>
                        <td class="px-6 py-4 text-center">
                            <a href="?page=user&action=show&id=<?php echo $user['id_user']; ?>" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/user/index.php', $userIndex);

// User Profile
$userProfile = <<<'EOT'
<?php $pageTitle = 'Mon Profil'; require __DIR__ . '/../templates/header_tailwind.php'; ?>

<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-indigo-600 mb-8">👤 Mon Profil</h1>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Prénom</p>
                    <p class="text-xl font-semibold"><?php echo htmlspecialchars($user['prenom'] ?? ''); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Nom</p>
                    <p class="text-xl font-semibold"><?php echo htmlspecialchars($user['nom'] ?? ''); ?></p>
                </div>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-xl font-semibold"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Rôle</p>
                <span class="inline-block bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full"><?php echo htmlspecialchars($user['role']); ?></span>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Inscrit depuis</p>
                <p class="text-lg"><?php echo htmlspecialchars($user['date_inscription'] ?? 'N/A'); ?></p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t">
            <a href="?page=user&action=edit&id=<?php echo $user['id_user']; ?>" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-edit"></i> Éditer mon profil
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>
EOT;

file_put_contents($viewsDir . '/user/show.php', $userProfile);

echo "✅ Toutes les Views Tailwind ont été générées avec succès !\n";

?>
