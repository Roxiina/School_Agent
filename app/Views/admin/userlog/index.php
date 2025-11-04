<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>📜 Historique des connexions (User Log)</h1>

<p><a href="/admin">⬅️ Retour au dashboard</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID Log</th>
            <th>Utilisateur</th>
            <th>Dernière connexion</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['id_userlog']) ?></td>
                    <td><?= htmlspecialchars($log['nom'] . ' ' . $log['prenom']) ?> (ID: <?= $log['id_user'] ?>)</td>
                    <td><?= htmlspecialchars($log['derniere_connection']) ?></td>
                    <td>
                        <a href="/admin/userlog/show?id=<?= $log['id_userlog'] ?>">👁️ Voir</a> |
                        <a href="/admin/userlog/delete?id=<?= $log['id_userlog'] ?>"
                           onclick="return confirm('Supprimer ce log ?')">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Aucun log trouvé.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
