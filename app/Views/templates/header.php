<?php
use SchoolAgent\Config\Authenticator;

// On démarre la session sur toutes les pages
Authenticator::startSession();

$flash = Authenticator::getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Agent</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/agents.css">
    <script src="js/app.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="?" class="logo">🎓 School Agent</a>
                <nav>
                    <?php if (Authenticator::isLogged()): ?>
                        <ul class="nav-menu">
                            <li><a href="?page=dashboard">Tableau de bord</a></li>
                            <li><a href="?page=conversation">Conversations</a></li>
                            <li><a href="?page=subject">Matières</a></li>
                            <li><a href="?page=user">Utilisateurs</a></li>
                            <li><a href="?page=level">Niveaux</a></li>
                            <li><a href="?page=logout" class="btn btn-secondary">Déconnexion</a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="nav-menu">
                            <li><a href="?page=login" class="btn btn-primary">Connexion</a></li>
                        </ul>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if ($flash): ?>
                <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : 'success' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>