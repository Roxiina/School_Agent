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