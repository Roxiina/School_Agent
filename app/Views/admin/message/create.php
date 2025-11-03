<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Ajouter un message</h1>

<form action="/admin/message/create" method="POST">
    <input type="text" name="question" placeholder="Question" required><br>
    <input type="text" name="reponse" placeholder="Réponse" required><br>
    <input type="number" name="id_conversation" placeholder="ID Conversation" required><br>
    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
