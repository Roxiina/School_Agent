<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Connexion</h1>

<form method="POST" action="/login">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe</label><br>
    <input type="password" name="mot_de_passe" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php if (!empty($error)): ?>
    <div class="flash-message flash-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>