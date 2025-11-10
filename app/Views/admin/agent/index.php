<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des agents</h1>

<p><a href="/admin/agent/create">➕ Ajouter un agent</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($agents as $agent): ?>
        <tr>
            <td><?= $agent['id_agent'] ?></td>
            <td><?= htmlspecialchars($agent['nom']) ?></td>
            <td>
                <a href="/admin/agent/show?id=<?= $agent['id_agent'] ?>">👁️</a>
                <a href="/admin/agent/edit?id=<?= $agent['id_agent'] ?>">✏️</a>
                <a href="/admin/agent/delete?id=<?= $agent['id_agent'] ?>" onclick="return confirm('Supprimer cet agent ?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
