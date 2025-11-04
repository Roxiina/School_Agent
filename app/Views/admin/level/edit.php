<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier un niveau</h1>

<form action="/admin/level/edit/?id=<?= $level['id_niveau_scolaire'] ?>" method="POST">
    <input type="text" name="niveau" value="<?= htmlspecialchars($level['niveau']) ?>" required><br>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>