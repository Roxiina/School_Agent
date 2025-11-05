<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Liste des agents</h1>

<p><a href="/admin/agent/create">➕ Ajouter un agent</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Avatar</th>
        <th>Description</th>
        <th>Température</th>
        <th>System Prompt</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($agents as $agent): ?>
        <tr>
            <td><?= $agent['id_agent'] ?></td>
            <td><?= htmlspecialchars($agent['nom']) ?></td>
            <td><?= htmlspecialchars($agent['avatar'] ?? '') ?></td>
            <td><?= htmlspecialchars(substr($agent['description'] ?? '', 0, 50) . (strlen($agent['description'] ?? '') > 50 ? '...' : '')) ?></td>
            <td><?= htmlspecialchars($agent['temperature'] ?? '') ?></td>
            <td><?= htmlspecialchars(substr($agent['system_prompt'] ?? '', 0, 50) . (strlen($agent['system_prompt'] ?? '') > 50 ? '...' : '')) ?></td>
            <td>
                <a href="/admin/agent/show?id=<?= $agent['id_agent'] ?>">👁️</a>
                <a href="/admin/agent/edit?id=<?= $agent['id_agent'] ?>">✏️</a>
                <a href="/admin/agent/delete?id=<?= $agent['id_agent'] ?>" onclick="return confirm('Supprimer cet agent ?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
