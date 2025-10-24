<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Message <?= htmlspecialchars($message['question']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $message['id_message'] ?></li>
    <li><strong>Question :</strong> <?= htmlspecialchars($message['question']) ?></li>
    <li><strong>Réponse :</strong> <?= htmlspecialchars($message['reponse']) ?></li>
    <li><strong>Conversation :</strong> <?= htmlspecialchars($message['id_conversation']) ?></li>
</ul>

<p>
    <a href="/message">⬅ Retour à la liste</a> |
    <a href="/message/edit?id=<?= $message['id_message'] ?>">✏ Modifier</a> |
    <a href="/message/delete?id=<?= $message['id_message'] ?>" onclick="return confirm('Supprimer ce message ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>