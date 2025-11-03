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