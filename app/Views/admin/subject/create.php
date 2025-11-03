<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Ajouter une matière</h1>
<form action="/admin/subject/create" method="POST">
    <input type="text" name="nom" placeholder="Nom de la matière" required><br>
    <input type="number" name="id_agent" placeholder="Agent" required><br>
    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
