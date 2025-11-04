<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier la matière</h1>
<form action="/admin/subject/edit?id=<?= $subject['id_matiere'] ?>" method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($subject['nom']) ?>" required><br>
    <input type="number" name="id_agent" value="<?= htmlspecialchars($subject['id_agent']) ?>" required><br>
    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
