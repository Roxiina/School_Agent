<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des messages</h1>
<p><a href="/admin/message/create">➕ Ajouter un message</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($messages as $m): ?>
        <tr>
            <td><?= $m['id_message'] ?></td>
            <td><?= htmlspecialchars($m['question']) ?></td>
            <td>
                <a href="/admin/message/show?id=<?= $m['id_message'] ?>">👁️</a>
                <a href="/admin/message/edit?id=<?= $m['id_message'] ?>">✏️</a>
                <a href="/admin/message/delete?id=<?= $m['id_message'] ?>" onclick="return confirm('Supprimer ce message ?')">🗑</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
