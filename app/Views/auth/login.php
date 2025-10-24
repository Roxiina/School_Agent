<?php
use SchoolAgent\Config\Authenticator;

$flash = Authenticator::getFlash(); // 🔹 Récupère le message flash s'il existe
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - School Agent</title>
</head>
<body>

<?php if ($flash): ?>
    <div style="
        padding:10px;
        margin-bottom:10px;
        border-radius:5px;
        background-color:<?= $flash['type'] === 'success' ? '#d4edda' : '#cce5ff' ?>;
        color:<?= $flash['type'] === 'success' ? '#155724' : '#004085' ?>;
    ">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<h1>Connexion</h1>

<form method="POST" action="/login">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe</label><br>
    <input type="password" name="mot_de_passe" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

</body>
</html>
