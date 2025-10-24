<h1>Modifier la matière</h1>

<form action="/subject/edit/?id=<?= $subject['id_matiere'] ?>" method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($subject['nom']) ?>" required><br>
    <input type="number" name="id_agent" value="<?= $subject['id_agent'] ?>" required><br>
    <button type="submit">Modifier</button>
</form>