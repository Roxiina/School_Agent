<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier la conversation</h1>

<form action="/admin/conversation/edit?id=<?= $conversation['id_conversation'] ?>" method="POST">
    <input type="text" name="titre" value="<?= htmlspecialchars($conversation['titre']) ?>" required><br>
    <input type="text" name="date_creation" value="<?= htmlspecialchars($conversation['date_creation']) ?>" required><br>
    <input type="number" name="id_agent" value="<?= htmlspecialchars($conversation['id_agent']) ?>" required><br>
    <input type="number" name="id_user" value="<?= htmlspecialchars($conversation['id_user']) ?>" required><br>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
