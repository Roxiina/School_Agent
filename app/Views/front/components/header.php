<!-- HEADER COMPONENT -->
<header class="navbar">
    <div class="container">
        <a href="/home" class="logo">
            <div class="logo-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            School Agent
        </a>
        
        <nav class="nav-links">
            <a href="/home" class="nav-link">Accueil</a>
            <a href="/subjects" class="nav-link">Matières</a>
            <a href="/levels" class="nav-link">Niveaux</a>
            <a href="/conversations" class="nav-link">Mes Conversations</a>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/profile" class="nav-link">Profil</a>
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <a href="/admin" class="nav-link">Administration</a>
                <?php endif; ?>
                <a href="/logout" class="btn btn-primary">Déconnexion</a>
            <?php else: ?>
                <a href="/login" class="btn btn-primary">Connexion</a>
            <?php endif; ?>
        </nav>
        
        <button class="mobile-toggle md:hidden">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>