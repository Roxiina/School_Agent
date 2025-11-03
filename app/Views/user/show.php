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