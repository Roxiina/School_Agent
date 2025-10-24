<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Modifier une conversation</h1>

<form action="/conversation/edit/?id=<?= $conversation['id_conversation'] ?>" method="POST">
    <input type="text" name="titre" value="<?= htmlspecialchars($conversation['titre']) ?>" required><br>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>