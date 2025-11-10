<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistants IA - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/ia.css">
</head>
<body>
    <!-- Flash Messages -->
    <?php
    use SchoolAgent\Config\Authenticator;
    $flash = Authenticator::getFlash();
    if ($flash): ?>
        <div class="flash-message flash-<?= $flash['type'] ?>" style="position: fixed; top: 20px; right: 20px; z-index: 1000; padding: 15px 20px; border-radius: 5px; color: white; font-weight: 500;">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
        <script>
            // Faire disparaître le message après 5 secondes
            setTimeout(() => {
                const flashMsg = document.querySelector('.flash-message');
                if (flashMsg) flashMsg.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>

    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <ul class="nav-menu">
                <li><a href="/home" class="nav-link">Accueil</a></li>
                <li><a href="/ia" class="nav-link active">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged && isset($user['role']) && $user['role'] === 'etudiant'): ?>
                    <li><a href="/ia" class="nav-link" style="color: #10b981; font-weight: 600;">💬 Discuter</a></li>
                <?php endif; ?>
                <?php if (isset($isLogged) && $isLogged): ?>
                    <li><span class="nav-welcome" style="color: #10b981; font-weight: 500; padding: 8px 16px;">
                        Bonjour <?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?> ! 👋
                    </span></li>
                    <li><a href="/profile" class="btn btn-secondary" style="background: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">👤 Mon Profil</a></li>
                    <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                        <li><a href="/admin" class="btn btn-secondary" style="background: #6366f1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Administration</a></li>
                    <?php endif; ?>
                    <li><a href="/logout" class="btn btn-danger" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/login" class="btn btn-primary">Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="ia-page">
        <!-- Hero Simple -->
        <section class="page-hero">
            <div class="container">
                <div class="hero-content">
                    <span class="hero-badge">
                        <i class="fas fa-robot"></i>
                        Intelligence Artificielle
                    </span>
                    <h1 class="hero-title">
                        Choisissez votre <span class="highlight">Assistant IA</span>
                    </h1>
                    <p class="hero-desc">
                        Des assistants intelligents pour vous accompagner dans votre apprentissage
                    </p>
                </div>
            </div>
        </section>

        <!-- Agents Grid -->
        <section class="agents-section">
            <div class="container">
                <?php if (!empty($agents)): ?>
                    <div class="agents-grid">
                        <?php foreach ($agents as $agent): ?>
                            <article class="agent-card">
                                <div class="card-header">
                                    <div class="agent-avatar">
                                        <?= strtoupper(substr($agent['name'], 0, 1)) ?>
                                    </div>
                                    <span class="status-badge">
                                        <i class="fas fa-circle"></i>
                                        <?= $agent['status'] === 'active' ? 'Disponible' : 'Hors ligne' ?>
                                    </span>
                                </div>
                                
                                <div class="card-body">
                                    <h3 class="agent-name"><?= htmlspecialchars($agent['name']) ?></h3>
                                    <p class="agent-desc"><?= htmlspecialchars($agent['description']) ?></p>
                                </div>
                                
                                <div class="card-footer">
                                    <a href="/ia/conversations?id=<?= $agent['id'] ?>" class="btn-primary">
                                        <i class="fas fa-comments"></i>
                                        <span>Discuter</span>
                                    </a>
                                    <a href="/ia/conversations?id=<?= $agent['id'] ?>" class="btn-secondary">
                                        <i class="fas fa-history"></i>
                                        <span>Historique</span>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3>Aucun assistant disponible</h3>
                        <p>Les assistants IA ne sont pas encore configurés</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 School Agent. Tous droits réservés. Fait avec ❤️ pour l'éducation et l'apprentissage.</p>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="/js/front/home.js"></script>
</body>
</html>
