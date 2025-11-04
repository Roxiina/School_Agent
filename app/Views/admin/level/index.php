<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des niveaux</h1>

<a href="/admin/level/create">➕ Ajouter un niveau</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Niveau</th><th>Action</th>
    </tr>
    <?php foreach ($levels as $level): ?>
    <tr>
        <td><?= $level['id_niveau_scolaire'] ?></td>
        <td><?= htmlspecialchars($level['niveau']) ?></td>
        <td>
            <a href="/admin/level/show?id=<?= $level['id_niveau_scolaire'] ?>">👁️</a>
            <a href="/admin/level/edit?id=<?= $level['id_niveau_scolaire'] ?>">✏️</a>
            <a href="/admin/level/delete?id=<?= $level['id_niveau_scolaire'] ?>" onclick="return confirm('Supprimer ce niveau ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/home" class="btn btn-outline-secondary">← Retour à l’accueil</a>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>