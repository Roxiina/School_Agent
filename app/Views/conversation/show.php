<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Conversation <?= htmlspecialchars($conversation['titre']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $conversation['id_conversation'] ?></li>
    <li><strong>Niveau Scolaire :</strong> <?= htmlspecialchars($conversation['titre']) ?></li>
</ul>

<p>
    <a href="/conversation">⬅ Retour à la liste</a> |
    <a href="/conversation/edit?id=<?= $conversation['id_conversation'] ?>">✏ Modifier</a> |
    <a href="/conversation/delete?id=<?= $conversation['id_conversation'] ?>" onclick="return confirm('Supprimer cette conversation ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>