<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Agent - Assistant IA pour l'apprentissage</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
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
                <li><a href="#accueil" class="nav-link active">Accueil</a></li>
                <li><a href="/agents" class="nav-link">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged && isset($user['role']) && $user['role'] === 'etudiant'): ?>
                    <li><a href="/conversation" class="nav-link" style="color: #10b981; font-weight: 600;">💬 Discuter</a></li>
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

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <div class="hero-container">
            <h1 class="hero-title animate-fade-in">
                Bienvenue sur School Agent ! 🎓
            </h1>
            <p class="hero-subtitle animate-fade-in">
                Votre assistant IA personnel pour l'apprentissage. Transformez votre façon d'étudier avec une intelligence artificielle adaptée à votre niveau et vos besoins.
            </p>
            <div class="hero-buttons animate-fade-in">
                <?php if (isset($isLogged) && $isLogged): ?>
                    <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                        <a href="/admin" class="btn btn-primary btn-large">
                            <i class="fas fa-cogs"></i>
                            Accéder à l'administration
                        </a>
                    <?php else: ?>
                        <a href="/agents" class="btn btn-primary btn-large">
                            <i class="fas fa-graduation-cap"></i>
                            Commencer à apprendre
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="/login" class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i>
                        Commencer maintenant
                    </a>
                <?php endif; ?>
                <a href="/agents" class="btn btn-outline btn-large">
                    <i class="fas fa-info-circle"></i>
                    Découvrir les fonctionnalités
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fonctionnalites">
        <div class="container">
            <h2 class="section-title">Pourquoi choisir School Agent ?</h2>
            <p class="section-subtitle">
                Découvrez comment notre IA révolutionne votre expérience d'apprentissage
            </p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">IA Adaptative</h3>
                    <p class="feature-description">
                        Notre intelligence artificielle s'adapte à votre niveau et à votre rythme d'apprentissage pour des explications personnalisées.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="feature-title">Toutes les matières</h3>
                    <p class="feature-description">
                        Mathématiques, français, histoire, sciences... School Agent couvre l'ensemble du programme scolaire de tous les niveaux.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="feature-title">Dialogue interactif</h3>
                    <p class="feature-description">
                        Posez vos questions en langage naturel et obtenez des réponses claires, détaillées et adaptées à votre niveau.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Suivi des progrès</h3>
                    <p class="feature-description">
                        Visualisez votre évolution, identifiez vos points forts et les domaines à améliorer avec nos outils d'analyse.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">Disponible 24/7</h3>
                    <p class="feature-description">
                        Apprenez quand vous voulez, où vous voulez. School Agent est toujours là pour vous accompagner dans vos études.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Sécurisé & Fiable</h3>
                    <p class="feature-description">
                        Vos données sont protégées et votre apprentissage se fait dans un environnement sûr, bienveillant et sans jugement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Étudiants actifs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-label">Questions résolues</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Taux de satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support disponible</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Prêt à révolutionner votre apprentissage ?</h2>
            <p class="cta-subtitle">
                Rejoignez des milliers d'étudiants qui utilisent déjà School Agent pour améliorer leurs résultats scolaires et leur compréhension.
            </p>
            <?php if (isset($isLogged) && $isLogged): ?>
                <a href="/agents" class="btn btn-primary btn-large">
                    <i class="fas fa-graduation-cap"></i>
                    Continuer votre apprentissage
                </a>
            <?php else: ?>
                <a href="/login" class="btn btn-primary btn-large">
                    <i class="fas fa-user-plus"></i>
                    Créer mon compte gratuitement
                </a>
            <?php endif; ?>
        </div>
    </section>

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