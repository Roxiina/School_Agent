<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Ajouter une conversation</h1>

<form action="/conversation/create" method="POST">
    <input type="text" name="conversation" placeholder="Conversation" required><br>
    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>