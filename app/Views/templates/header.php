<?php
use SchoolAgent\Config\Authenticator;

Authenticator::startSession();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'School Agent'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #667eea;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #666;
        }

        .logout-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #764ba2;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #764ba2;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .nav {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="?page=home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <nav class="nav">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <a href="?page=conversation"><i class="fas fa-comments"></i> Conversations</a>
                    <a href="?page=level"><i class="fas fa-book"></i> Niveaux</a>
                    <a href="?page=subject"><i class="fas fa-bookmark"></i> Matières</a>
                    <a href="?page=user"><i class="fas fa-user"></i> Profil</a>
                    <div class="user-info">
                        <span><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?></span>
                        <a href="?page=logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                <?php else: ?>
                    <a href="?page=login" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> ' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>
    <div>
    <?php if (Authenticator::isLogged()): ?>
        <a href="/logout">Se déconnecter</a>
    <?php else: ?>
        <a href="/login">Se connecter</a>
    <?php endif; ?>
    </div>
</nav>

<main>
    <?php 
    $flash = $_SESSION['flash'] ?? null;
    if ($flash): 
    ?>
        <div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>