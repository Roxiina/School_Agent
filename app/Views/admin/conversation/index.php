<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des conversations</h1>
<p><a href="/admin/conversation/create">➕ Ajouter une conversation</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Agent</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($conversations as $c): ?>
        <tr>
            <td><?= $c['id_conversation'] ?></td>
            <td><?= htmlspecialchars($c['titre']) ?></td>
            <td><?= htmlspecialchars($c['id_agent']) ?></td>
            <td><?= htmlspecialchars($c['id_user']) ?></td>
            <td>
                <a href="/admin/conversation/show?id=<?= $c['id_conversation'] ?>">👁️</a>
                <a href="/admin/conversation/edit?id=<?= $c['id_conversation'] ?>">✏️</a>
                <a href="/admin/conversation/delete?id=<?= $c['id_conversation'] ?>" onclick="return confirm('Supprimer cette conversation (ATTENTION CASCADE) ?')">🗑</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
