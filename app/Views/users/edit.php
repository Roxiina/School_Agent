<h1>Modifier l'utilisateur</h1>

<form action="/users/edit/?id=<?= $user['id_user'] ?>" method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br>
    <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe (laisser vide si inchangé)"><br>
    <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>"><br>
    <input type="number" name="id_niveau_scolaire" value="<?= $user['id_niveau_scolaire'] ?>" required><br>
    <button type="submit">Modifier</button>
</form>
