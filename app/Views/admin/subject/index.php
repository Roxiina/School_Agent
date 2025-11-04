<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des matières</h1>
<p><a href="/admin/subject/create">➕ Ajouter une matière</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Agent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($subjects as $s): ?>
        <tr>
            <td><?= $s['id_matiere'] ?></td>
            <td><?= htmlspecialchars($s['nom']) ?></td>
            <td><?= htmlspecialchars($s['id_agent']) ?></td>
            <td>
                <a href="/admin/subject/show?id=<?= $s['id_matiere'] ?>">👁️</a>
                <a href="/admin/subject/edit?id=<?= $s['id_matiere'] ?>">✏️</a>
                <a href="/admin/subject/delete?id=<?= $s['id_matiere'] ?>" onclick="return confirm('Supprimer cette matière ?')">🗑</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
