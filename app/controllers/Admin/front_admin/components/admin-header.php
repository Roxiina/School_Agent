<?php
/**
 * HEADER ADMIN - Interface d'administration School Agent
 */

// Démarrage de la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérification simple de la session
if (!isset($_SESSION['is_logged']) || !$_SESSION['is_logged'] || !isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$current_page = $_GET['page'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Administration - School Agent</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/app/front/images/favicon.ico">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="/app/front_admin/css/admin-style.css">
    
    <!-- Meta Description -->
    <meta name="description" content="Interface d'administration School Agent - Gestion des utilisateurs, conversations et contenus pédagogiques">
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="admin-layout">
    
    <!-- Header Admin -->
    <header class="admin-header">
        <nav class="admin-navbar">
            <!-- Logo Admin -->
            <a href="/admin" class="admin-logo">
                <i class="fas fa-shield-alt"></i>
                <span>School Agent Admin</span>
            </a>
            
            <!-- Navigation Admin -->
            <div class="admin-nav-links">
                <a href="/admin" class="admin-nav-link <?= $current_page === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    Tableau de bord
                </a>
                
                <a href="/admin/users" class="admin-nav-link <?= $current_page === 'users' ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>
                    Utilisateurs
                </a>
                
                <a href="/admin/conversations" class="admin-nav-link <?= $current_page === 'conversations' ? 'active' : '' ?>">
                    <i class="fas fa-comments"></i>
                    Conversations
                </a>
                
                <a href="/admin/subjects" class="admin-nav-link <?= $current_page === 'subjects' ? 'active' : '' ?>">
                    <i class="fas fa-book"></i>
                    Matières
                </a>
                
                <a href="/admin/levels" class="admin-nav-link <?= $current_page === 'levels' ? 'active' : '' ?>">
                    <i class="fas fa-layer-group"></i>
                    Niveaux
                </a>
                
                <!-- Profil Admin -->
                <div class="admin-user-menu">
                    <button class="admin-nav-link admin-user-toggle">
                        <i class="fas fa-user-shield"></i>
                        <?= htmlspecialchars($_SESSION['user_prenom'] ?? 'Admin') ?>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <div class="admin-user-dropdown">
                        <a href="/admin/profile" class="admin-dropdown-link">
                            <i class="fas fa-user-cog"></i>
                            Mon profil
                        </a>
                        
                        <a href="/admin/settings" class="admin-dropdown-link">
                            <i class="fas fa-cog"></i>
                            Paramètres
                        </a>
                        
                        <hr class="admin-dropdown-divider">
                        
                        <a href="/home" class="admin-dropdown-link">
                            <i class="fas fa-globe"></i>
                            Voir le site
                        </a>
                        
                        <a href="/logout" class="admin-dropdown-link admin-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Notifications Container -->
    <div class="admin-notifications-container"></div>
    
    <!-- Main Content -->
    <main class="admin-main">
        
        <?php if (isset($show_breadcrumbs) && $show_breadcrumbs): ?>
        <!-- Breadcrumbs -->
        <div class="admin-container">
            <nav class="admin-breadcrumbs">
                <a href="/admin">
                    <i class="fas fa-home"></i>
                    Administration
                </a>
                
                <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                        <i class="fas fa-chevron-right"></i>
                        <?php if (isset($breadcrumb['url'])): ?>
                            <a href="<?= htmlspecialchars($breadcrumb['url']) ?>">
                                <?= htmlspecialchars($breadcrumb['title']) ?>
                            </a>
                        <?php else: ?>
                            <span class="current"><?= htmlspecialchars($breadcrumb['title']) ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </nav>
        </div>
        <?php endif; ?>

<style>
/* Styles spécifiques pour le header admin */
.admin-user-menu {
    position: relative;
}

.admin-user-toggle {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    background: rgba(255, 255, 255, 0.1);
    border: none;
    cursor: pointer;
    font-family: inherit;
}

.admin-user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--gray-200);
    min-width: 200px;
    padding: var(--spacing-2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 100;
}

.admin-user-menu:hover .admin-user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.admin-dropdown-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-3) var(--spacing-4);
    color: var(--gray-700);
    text-decoration: none;
    border-radius: var(--radius);
    font-size: var(--font-size-sm);
    transition: all 0.3s ease;
}

.admin-dropdown-link:hover {
    background: var(--gray-50);
    color: var(--admin-primary);
}

.admin-dropdown-link.admin-logout:hover {
    background: #fee2e2;
    color: var(--admin-error);
}

.admin-dropdown-divider {
    border: none;
    border-top: 1px solid var(--gray-200);
    margin: var(--spacing-2) 0;
}

/* Animation du chevron */
.admin-user-menu:hover .admin-user-toggle .fa-chevron-down {
    transform: rotate(180deg);
}

.admin-user-toggle .fa-chevron-down {
    transition: transform 0.3s ease;
    font-size: var(--font-size-xs);
}

/* Responsive */
@media (max-width: 768px) {
    .admin-navbar {
        padding: 0 var(--spacing-4);
    }
    
    .admin-nav-links {
        flex-wrap: wrap;
        gap: var(--spacing-2);
    }
    
    .admin-nav-link {
        font-size: var(--font-size-sm);
        padding: var(--spacing-2) var(--spacing-3);
    }
    
    .admin-logo {
        font-size: var(--font-size-lg);
    }
    
    .admin-user-dropdown {
        right: auto;
        left: 0;
        min-width: 180px;
    }
}

/* Indicateur de page active */
.admin-nav-link.active {
    background: rgba(255, 255, 255, 0.2);
    font-weight: 600;
}

.admin-nav-link.active i {
    color: var(--admin-accent);
}
</style>

<script>
// Gestion du menu utilisateur admin
document.addEventListener('DOMContentLoaded', function() {
    // Auto-fermeture du menu utilisateur
    document.addEventListener('click', function(e) {
        const userMenu = document.querySelector('.admin-user-menu');
        if (userMenu && !userMenu.contains(e.target)) {
            userMenu.classList.remove('active');
        }
    });
    
    // Toggle menu utilisateur sur mobile
    const userToggle = document.querySelector('.admin-user-toggle');
    if (userToggle) {
        userToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const userMenu = this.closest('.admin-user-menu');
            userMenu.classList.toggle('active');
        });
    }
    
    // Confirmation de déconnexion
    const logoutLink = document.querySelector('.admin-logout');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                window.location.href = this.href;
            }
        });
    }
});
</script>