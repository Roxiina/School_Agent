<h1>Modifier un niveau</h1>

<form action="/level/edit/?id=<?= $level['id_niveau_scolaire'] ?>" method="POST">
    <input type="text" name="niveau" value="<?= htmlspecialchars($level['niveau']) ?>" required><br>
    <button type="submit">Modifier</button>
</form>