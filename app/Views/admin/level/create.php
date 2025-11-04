<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Ajouter un niveau</h1>

<form action="/admin/level/create" method="POST">
    <input type="text" name="niveau" placeholder="Niveau" required><br>
    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>