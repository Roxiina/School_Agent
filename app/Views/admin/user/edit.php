<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier l'utilisateur</h1>

<form action="/admin/user/edit?id=<?= $user['id_user'] ?>" method="POST">
    <label>Nom</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

    <label>Prénom</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Nouveau mot de passe</label>
    <input type="password" name="mot_de_passe" placeholder="Laisser vide pour ne pas changer">

    <label>Rôle</label>
    <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>">

    <label>ID Niveau scolaire</label>
    <input type="number" name="id_niveau_scolaire" value="<?= htmlspecialchars($user['id_niveau_scolaire']) ?>" required>

    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
