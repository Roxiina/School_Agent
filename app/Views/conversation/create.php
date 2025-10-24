<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Ajouter une conversation</h1>
<form action="/conversation/create" method="POST">
    <label>Conversation</label>
    <input type="text" name="titre" placeholder="Titre" required>
    <label>Date de création</label>
    <input type="text" name="date_creation" placeholder="Date de création" required>
    <label>ID Agent</label>
    <input type="number" name="id_agent" placeholder="ID Agent" required>
    <label>ID User</label>
    <input type="number" name="id_user" placeholder="ID User" required>
    <button type="submit">Enregistrer</button>
</form>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>