<h1>Ajouter un utilisateur</h1>

<form action="/user/create" method="POST">
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="text" name="prenom" placeholder="Prénom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
    <input type="text" name="role" value="etudiant"><br>
    <input type="number" name="id_niveau_scolaire" placeholder="Niveau scolaire" required><br>
    <button type="submit">Enregistrer</button>
</form>
