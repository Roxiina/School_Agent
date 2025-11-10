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
    <title>School Agent</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f9f9f9; }
        .container { max-width: 1200px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .flash-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
            border: 1px solid;
        }
        .flash-success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
        .flash-info { background-color: #cce5ff; color: #004085; border-color: #b8daff; }
        .flash-error { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
        nav { background-color: #333; color: white; padding: 10px 20px; margin-bottom: 20px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
        nav a:hover { text-decoration: underline; }
        footer { text-align: center; margin-top: 30px; color: #777; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-top: 20px; }
        form input, form button { padding: 10px; margin-bottom: 10px; width: calc(100% - 22px); }
        form button { width: 100%; cursor: pointer; background-color: #333; color: white; border: none; }
    </style>
</head>
<body>
<div class="container">

<nav>
    <div>
        <a href="/home">Accueil</a>
    </div>
    <div>
    <?php if (Authenticator::isLogged()): ?>
        <a href="/logout">Se déconnecter</a>
    <?php else: ?>
        <a href="/login">Se connecter</a>
    <?php endif; ?>
    </div>
</nav>

<main>
    <?php if ($flash): ?>
        <div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>
