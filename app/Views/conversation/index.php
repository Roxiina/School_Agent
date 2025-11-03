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