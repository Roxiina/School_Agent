<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Conversation <?= htmlspecialchars($conversation['titre']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $conversation['id_conversation'] ?></li>
    <li><strong>Titre :</strong> <?= htmlspecialchars($conversation['titre']) ?></li>
    <li><strong>Date de création :</strong> <?= htmlspecialchars($conversation['date_creation']) ?></li>
    <li><strong>ID Agent :</strong> <?= htmlspecialchars($conversation['id_agent']) ?></li>
    <li><strong>ID User :</strong> <?= htmlspecialchars($conversation['id_user']) ?></li>
</ul>

<p>
    <a href="/admin/conversation">⬅ Retour à la liste</a> |
    <a href="/admin/conversation/edit?id=<?= $conversation['id_conversation'] ?>">✏ Modifier</a> |
    <a href="/admin/conversation/delete?id=<?= $conversation['id_conversation'] ?>" onclick="return confirm('Supprimer cette conversation ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
