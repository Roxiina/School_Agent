<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Ajouter un utilisateur</h1>

<form action="/user/create" method="POST">
    <label>Nom</label>
    <input type="text" name="nom" placeholder="Nom" required>
    <label>Prénom</label>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required>
    <label>Mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <label>Rôle</label>
    <input type="text" name="role" value="etudiant">
    <label>ID Niveau scolaire</label>
    <input type="number" name="id_niveau_scolaire" placeholder="Niveau scolaire" required>
    <button type="submit">Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>