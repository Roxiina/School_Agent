<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier le message</h1>

<form action="/admin/message/edit?id=<?= $message['id_message'] ?>" method="POST">
    <input type="text" name="question" value="<?= htmlspecialchars($message['question']) ?>" required><br>
    <input type="text" name="reponse" value="<?= htmlspecialchars($message['reponse']) ?>" required><br>
    <input type="number" name="id_conversation" value="<?= $message['id_conversation'] ?>" required><br>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
