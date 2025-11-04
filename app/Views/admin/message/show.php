<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Message <?= htmlspecialchars($message['question']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $message['id_message'] ?></li>
    <li><strong>Question :</strong> <?= htmlspecialchars($message['question']) ?></li>
    <li><strong>Réponse :</strong> <?= htmlspecialchars($message['reponse']) ?></li>
    <li><strong>ID Conversation :</strong> <?= htmlspecialchars($message['id_conversation']) ?></li>
</ul>

<p>
    <a href="/admin/message">⬅ Retour à la liste</a> |
    <a href="/admin/message/edit?id=<?= $message['id_message'] ?>">✏ Modifier</a> |
    <a href="/admin/message/delete?id=<?= $message['id_message'] ?>" onclick="return confirm('Supprimer ce message ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
