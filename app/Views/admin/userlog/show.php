<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>📄 Détails du log #<?= htmlspecialchars($log['id_userlog']) ?></h1>

<p><a href="/admin/userlog">⬅️ Retour à la liste</a></p>

<ul>
    <li><strong>ID Log :</strong> <?= htmlspecialchars($log['id_userlog']) ?></li>
    <li><strong>Utilisateur :</strong> <?= htmlspecialchars($log['nom'] . ' ' . $log['prenom']) ?> (ID: <?= $log['id_user'] ?>)</li>
    <li><strong>Dernière connexion :</strong> <?= htmlspecialchars($log['derniere_connection']) ?></li>
</ul>

<p>
    <a href="/admin/userlog/delete?id=<?= $log['id_userlog'] ?>"
       onclick="return confirm('Supprimer ce log ?')">🗑️ Supprimer</a>
</p>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
