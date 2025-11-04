<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>📋 Relations Utilisateur – Agent</h1>

<p><a href="/admin">⬅️ Retour au dashboard</a></p>
<p><a href="/admin/useragent/create">➕ Ajouter une relation</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Agent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($relations)): ?>
            <?php foreach ($relations as $rel): ?>
                <tr>
                    <td><?= htmlspecialchars($rel['user_nom'] . ' ' . $rel['user_prenom']) ?></td>
                    <td><?= htmlspecialchars($rel['agent_nom']) ?></td>
                    <td>
                        <a href="/admin/useragent/edit?id_user=<?= $rel['id_user'] ?>&id_agent=<?= $rel['id_agent'] ?>">✏️ Modifier</a> |
                        <a href="/admin/useragent/delete?id_user=<?= $rel['id_user'] ?>&id_agent=<?= $rel['id_agent'] ?>"
                           onclick="return confirm('Supprimer cette relation ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">Aucune relation trouvée.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
