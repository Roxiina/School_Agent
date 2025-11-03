<?php 
$title = "Tableau de bord Étudiant - School Agent";
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();
$flash = Authenticator::getFlash();
$userName = Authenticator::getUserName();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #2c3e50;
        }
        
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
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
            padding: 0 2rem;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .welcome-text {
            color: #64748b;
            font-weight: 500;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }
        
        .btn-logout {
            background: #ef4444;
            color: white;
        }
        
        .btn-logout:hover {
            background: #dc2626;
        }
        
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        
        .card p {
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .card-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .card-link:hover {
            color: #5a6fd8;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .flash-message {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }
        
        .flash-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .flash-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="?" class="logo">🎓 School Agent</a>
            <div class="user-menu">
                <span class="welcome-text">Bonjour, <?= htmlspecialchars($userName) ?></span>
                <a href="?page=logout" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </header>

    <!-- Message flash -->
    <?php if ($flash): ?>
        <div class="flash-message flash-<?= $flash['type'] ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- Contenu principal -->
    <main class="main-content">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 2rem; text-align: center;">
            Tableau de bord Étudiant
        </h1>

        <!-- Statistiques -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div class="stat-label">Agents disponibles</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div class="stat-label">Conversations actives</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2</div>
                <div class="stat-label">Matières étudiées</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">15</div>
                <div class="stat-label">Messages échangés</div>
            </div>
        </div>

        <!-- Actions principales -->
        <div class="dashboard-grid">
            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Mes Conversations</h3>
                <p>Accédez à vos conversations avec les agents IA et continuez vos échanges d'apprentissage.</p>
                <a href="?page=conversation" class="card-link">
                    Voir mes conversations <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h3>Agents IA</h3>
                <p>Découvrez les agents spécialisés disponibles pour vous aider dans vos études.</p>
                <a href="?page=agent" class="card-link">
                    Choisir un agent <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Matières</h3>
                <p>Explorez les différentes matières et trouvez l'aide dont vous avez besoin.</p>
                <a href="?page=subject" class="card-link">
                    Explorer les matières <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="card">
                <div class="card-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h3>Mon Profil</h3>
                <p>Gérez vos informations personnelles et vos préférences d'apprentissage.</p>
                <a href="?page=profile" class="card-link">
                    Modifier mon profil <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </main>

    <script>
        // Masquer automatiquement les messages flash après 5 secondes
        setTimeout(() => {
            const flashMessage = document.querySelector('.flash-message');
            if (flashMessage) {
                flashMessage.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => flashMessage.remove(), 300);
            }
        }, 5000);
    </script>
</body>
</html>