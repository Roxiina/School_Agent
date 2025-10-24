<?php
use SchoolAgent\Config\Authenticator;

$flash = Authenticator::getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - School Agent</title>
</head>
<body>

<?php
// Dump de debug
echo "<pre style='background:#222;color:#0f0;padding:10px;border-radius:5px;'>";
echo "=== DEBUG SESSION ===\n";
var_dump($_SESSION);
echo "</pre>";
?>


<h1>Bienvenue sur School Agent !</h1>

<p><a href="/users">Voir la liste des utilisateurs</a></p>
<p><a href="/login">Se connecter</a> | <a href="/logout">Se déconnecter</a></p>

<p>Hello le world 👋</p>

</body>
</html>
