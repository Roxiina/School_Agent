<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/login.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <ul class="nav-menu">
                <li><a href="/home" class="nav-link">Accueil</a></li>
                <li><a href="/agents" class="nav-link">Nos Agents</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Login Container -->
    <main class="login-container">
        <!-- Login Header -->
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h1 class="login-title">Bon retour !</h1>
            <p class="login-subtitle">Connectez-vous pour accéder à votre assistant IA d'apprentissage</p>
        </div>

        <!-- Flash Messages -->
        <?php if (!empty($error)): ?>
            <div class="flash-message flash-error">
                <i class="fas fa-exclamation-triangle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="/login" class="login-form">
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Adresse email
                </label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    class="form-input"
                    placeholder="votre@email.com"
                    required
                    autocomplete="email"
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <input 
                    type="password" 
                    id="password"
                    name="mot_de_passe" 
                    class="form-input"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                Se connecter
            </button>
        </form>

        <!-- Additional Links -->
        <div class="login-links">
            <p>Pas encore de compte ? <a href="/register" class="login-link">Créer un compte</a></p>
            <p><a href="/forgot-password" class="login-link">Mot de passe oublié ?</a></p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="login-footer">
        <p>&copy; 2025 School Agent. Tous droits réservés. 
           <a href="/home">Retour à l'accueil</a>
        </p>
    </footer>

    <!-- Custom JavaScript -->
        </footer>
    
    <!-- JavaScript -->
    <script src="/js/front/login.js"></script> <!-- Réactivé -->
    <script>
    <script>
        // Version simplifiée pour debug
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page de login chargée');
            
            const form = document.querySelector('.login-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Soumission du formulaire');
                    // Pas de preventDefault() - laisse la soumission normale
                });
            }
        });
    </script>
</body>
</html>