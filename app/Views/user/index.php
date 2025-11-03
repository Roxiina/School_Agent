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