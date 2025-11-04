<?php
/**
 * DASHBOARD ADMIN - Interface principale d'administration
 */

// Configuration de la page
$page_title = "Tableau de bord";
$show_breadcrumbs = false;

// Inclusion des composants
require_once __DIR__ . '/../components/admin-components.php';

// Simulation de données (en production, ces données viendraient de la base)
$stats = [
    'total_users' => 156,
    'total_conversations' => 234,
    'total_messages' => 1567,
    'active_sessions' => 23
];

$recent_activities = [
    [
        'type' => 'user_registered',
        'message' => 'Nouvel utilisateur inscrit : Marie Dubois',
        'time' => '5 min',
        'icon' => 'fas fa-user-plus',
        'color' => 'success'
    ],
    [
        'type' => 'conversation_started',
        'message' => 'Nouvelle conversation avec Agent Mathéo',
        'time' => '12 min',
        'icon' => 'fas fa-comments',
        'color' => 'info'
    ],
    [
        'type' => 'error_logged',
        'message' => 'Erreur de connexion base de données (résolue)',
        'time' => '25 min',
        'icon' => 'fas fa-exclamation-triangle',
        'color' => 'warning'
    ],
    [
        'type' => 'backup_completed',
        'message' => 'Sauvegarde automatique terminée',
        'time' => '1h',
        'icon' => 'fas fa-check-circle',
        'color' => 'success'
    ]
];

$top_subjects = [
    ['name' => 'Mathématiques', 'conversations' => 45, 'progress' => 78],
    ['name' => 'Histoire', 'conversations' => 32, 'progress' => 65],
    ['name' => 'Français', 'conversations' => 28, 'progress' => 58],
    ['name' => 'Sciences', 'conversations' => 21, 'progress' => 42]
];

$system_status = [
    'database' => 'online',
    'api' => 'online',
    'storage' => 'online',
    'backup' => 'pending'
];

// Inclusion du header
require_once __DIR__ . '/../components/admin-header.php';
?>

<div class="admin-container">
    
    <!-- Message de bienvenue -->
    <div class="admin-welcome-section admin-animate-fade-in">
        <div class="admin-welcome-content">
            <h1 class="admin-welcome-title">
                <i class="fas fa-chart-line"></i>
                Tableau de bord administrateur
            </h1>
            <p class="admin-welcome-text">
                Bienvenue dans l'interface d'administration de School Agent. 
                Gérez les utilisateurs, surveillez les conversations et analysez les performances.
            </p>
            <div class="admin-welcome-time">
                <i class="fas fa-clock"></i>
                Dernière connexion : <?= date('d/m/Y à H:i') ?>
            </div>
        </div>
    </div>
    
    <!-- Statistiques principales -->
    <div class="admin-stats-grid admin-animate-fade-in">
        <?= admin_stat_card('Utilisateurs totaux', $stats['total_users'], 'fas fa-users', 'red', '+12 ce mois') ?>
        <?= admin_stat_card('Conversations', $stats['total_conversations'], 'fas fa-comments', 'blue', '+34 cette semaine') ?>
        <?= admin_stat_card('Messages échangés', $stats['total_messages'], 'fas fa-envelope', 'green', '+156 aujourd\'hui') ?>
        <?= admin_stat_card('Sessions actives', $stats['active_sessions'], 'fas fa-circle', 'purple', 'En temps réel') ?>
    </div>
    
    <!-- Contenu principal en colonnes -->
    <div class="admin-dashboard-grid">
        
        <!-- Colonne gauche -->
        <div class="admin-dashboard-left">
            
            <!-- Activités récentes -->
            <?= admin_card(
                'Activités récentes',
                "
                <div class='admin-activities'>
                    " . implode('', array_map(function($activity) {
                        return "
                        <div class='admin-activity-item'>
                            <div class='admin-activity-icon admin-activity-{$activity['color']}'>
                                <i class='{$activity['icon']}'></i>
                            </div>
                            <div class='admin-activity-content'>
                                <p class='admin-activity-message'>{$activity['message']}</p>
                                <span class='admin-activity-time'>Il y a {$activity['time']}</span>
                            </div>
                        </div>";
                    }, $recent_activities)) . "
                </div>
                <div class='admin-card-footer'>
                    " . admin_button('Voir toutes les activités', '/admin/logs', 'outline', 'fas fa-list') . "
                </div>
                ",
                'fas fa-history'
            ) ?>
            
            <!-- Graphique des conversations par matière -->
            <?= admin_card(
                'Conversations par matière',
                "
                <div class='admin-subjects-chart'>
                    " . implode('', array_map(function($subject) {
                        return "
                        <div class='admin-subject-item'>
                            <div class='admin-subject-info'>
                                <span class='admin-subject-name'>{$subject['name']}</span>
                                <span class='admin-subject-count'>{$subject['conversations']} conversations</span>
                            </div>
                            <div class='admin-subject-progress'>
                                <div class='admin-progress-bar'>
                                    <div class='admin-progress-fill' style='width: {$subject['progress']}%'></div>
                                </div>
                                <span class='admin-progress-text'>{$subject['progress']}%</span>
                            </div>
                        </div>";
                    }, $top_subjects)) . "
                </div>
                ",
                'fas fa-chart-bar',
                [admin_button('Détails', '/admin/stats', 'sm', 'fas fa-external-link-alt')]
            ) ?>
            
        </div>
        
        <!-- Colonne droite -->
        <div class="admin-dashboard-right">
            
            <!-- Statut du système -->
            <?= admin_card(
                'Statut du système',
                "
                <div class='admin-system-status'>
                    " . implode('', array_map(function($service, $status) {
                        $status_config = [
                            'online' => ['text' => 'En ligne', 'color' => 'success', 'icon' => 'fas fa-check-circle'],
                            'offline' => ['text' => 'Hors ligne', 'color' => 'error', 'icon' => 'fas fa-times-circle'],
                            'pending' => ['text' => 'En attente', 'color' => 'warning', 'icon' => 'fas fa-clock']
                        ];
                        $config = $status_config[$status];
                        
                        return "
                        <div class='admin-status-item'>
                            <div class='admin-status-service'>
                                <i class='{$config['icon']} admin-status-{$config['color']}'></i>
                                <span>" . ucfirst($service) . "</span>
                            </div>
                            <span class='admin-status-text admin-status-{$config['color']}'>{$config['text']}</span>
                        </div>";
                    }, array_keys($system_status), $system_status)) . "
                </div>
                ",
                'fas fa-server'
            ) ?>
            
            <!-- Actions rapides -->
            <?= admin_card(
                'Actions rapides',
                "
                <div class='admin-quick-actions-grid'>
                    <a href='/admin/users/create' class='admin-quick-action-card'>
                        <div class='admin-quick-action-icon admin-icon-blue'>
                            <i class='fas fa-user-plus'></i>
                        </div>
                        <div class='admin-quick-action-content'>
                            <h4>Nouvel utilisateur</h4>
                            <p>Ajouter un utilisateur</p>
                        </div>
                    </a>
                    
                    <a href='/admin/backup' class='admin-quick-action-card'>
                        <div class='admin-quick-action-icon admin-icon-green'>
                            <i class='fas fa-download'></i>
                        </div>
                        <div class='admin-quick-action-content'>
                            <h4>Sauvegarde</h4>
                            <p>Créer une sauvegarde</p>
                        </div>
                    </a>
                    
                    <a href='/admin/settings' class='admin-quick-action-card'>
                        <div class='admin-quick-action-icon admin-icon-purple'>
                            <i class='fas fa-cog'></i>
                        </div>
                        <div class='admin-quick-action-content'>
                            <h4>Paramètres</h4>
                            <p>Configuration système</p>
                        </div>
                    </a>
                    
                    <a href='/admin/reports' class='admin-quick-action-card'>
                        <div class='admin-quick-action-icon admin-icon-orange'>
                            <i class='fas fa-chart-pie'></i>
                        </div>
                        <div class='admin-quick-action-content'>
                            <h4>Rapports</h4>
                            <p>Générer des rapports</p>
                        </div>
                    </a>
                </div>
                ",
                'fas fa-bolt'
            ) ?>
            
            <!-- Alertes et notifications -->
            <div class="admin-alerts-section">
                <?= admin_alert('Le système sera mis à jour automatiquement à 2h00 du matin.', 'info') ?>
                <?= admin_alert('3 nouvelles demandes d\'aide utilisateur en attente.', 'warning') ?>
            </div>
            
        </div>
        
    </div>
    
    <!-- Section des raccourcis -->
    <div class="admin-shortcuts-section">
        <h2 class="admin-section-title">
            <i class="fas fa-rocket"></i>
            Raccourcis administrateur
        </h2>
        
        <div class="admin-shortcuts-grid">
            <a href="/admin/users" class="admin-shortcut-card">
                <div class="admin-shortcut-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Gestion des utilisateurs</h3>
                <p>Gérer les comptes, rôles et permissions</p>
                <div class="admin-shortcut-badge"><?= $stats['total_users'] ?> utilisateurs</div>
            </a>
            
            <a href="/admin/conversations" class="admin-shortcut-card">
                <div class="admin-shortcut-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3>Conversations</h3>
                <p>Modérer et analyser les échanges</p>
                <div class="admin-shortcut-badge"><?= $stats['total_conversations'] ?> conversations</div>
            </a>
            
            <a href="/admin/subjects" class="admin-shortcut-card">
                <div class="admin-shortcut-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Matières scolaires</h3>
                <p>Configurer les matières et agents</p>
                <div class="admin-shortcut-badge">8 matières</div>
            </a>
            
            <a href="/admin/analytics" class="admin-shortcut-card">
                <div class="admin-shortcut-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Analyses</h3>
                <p>Statistiques et performances</p>
                <div class="admin-shortcut-badge">En temps réel</div>
            </a>
        </div>
    </div>
    
</div>

<?php
// Scripts spécifiques à cette page
$inline_scripts = "
    // Mise à jour des statistiques en temps réel (simulation)
    setInterval(function() {
        const sessions = document.querySelector('[data-count=\"{$stats['active_sessions']}\"]');
        if (sessions && Math.random() > 0.8) {
            const currentValue = parseInt(sessions.textContent);
            const newValue = Math.max(1, currentValue + (Math.random() > 0.5 ? 1 : -1));
            sessions.textContent = newValue;
            sessions.dataset.count = newValue;
            
            // Animation de changement
            sessions.parentElement.classList.add('admin-stat-updated');
            setTimeout(() => {
                sessions.parentElement.classList.remove('admin-stat-updated');
            }, 1000);
        }
    }, 10000);
    
    // Animation des barres de progression
    document.querySelectorAll('.admin-progress-fill').forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });
";

// Inclusion du footer
require_once __DIR__ . '/../components/admin-footer.php';
?>

<style>
/* Styles spécifiques au dashboard */
.admin-welcome-section {
    background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
    color: white;
    padding: var(--spacing-8);
    border-radius: var(--radius-2xl);
    margin-bottom: var(--spacing-8);
    position: relative;
    overflow: hidden;
}

.admin-welcome-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 100%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.admin-welcome-content {
    position: relative;
    z-index: 1;
}

.admin-welcome-title {
    font-size: var(--font-size-3xl);
    font-weight: 800;
    margin-bottom: var(--spacing-4);
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.admin-welcome-text {
    font-size: var(--font-size-lg);
    opacity: 0.9;
    margin-bottom: var(--spacing-4);
    line-height: 1.6;
}

.admin-welcome-time {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    background: rgba(255, 255, 255, 0.1);
    padding: var(--spacing-3) var(--spacing-4);
    border-radius: var(--radius-lg);
    display: inline-flex;
}

/* Dashboard Grid */
.admin-dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: var(--spacing-8);
    margin-bottom: var(--spacing-8);
}

/* Activités */
.admin-activities {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-4);
}

.admin-activity-item {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-4);
    padding: var(--spacing-4);
    border-radius: var(--radius-lg);
    transition: all 0.3s ease;
}

.admin-activity-item:hover {
    background: var(--gray-50);
}

.admin-activity-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: var(--font-size-sm);
    flex-shrink: 0;
}

.admin-activity-success { background: var(--admin-success); }
.admin-activity-warning { background: var(--admin-warning); }
.admin-activity-error { background: var(--admin-error); }
.admin-activity-info { background: var(--admin-primary); }

.admin-activity-message {
    font-weight: 500;
    color: var(--gray-800);
    margin-bottom: var(--spacing-1);
}

.admin-activity-time {
    font-size: var(--font-size-sm);
    color: var(--gray-500);
}

/* Matières chart */
.admin-subjects-chart {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-4);
}

.admin-subject-item {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-2);
}

.admin-subject-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.admin-subject-name {
    font-weight: 600;
    color: var(--gray-800);
}

.admin-subject-count {
    font-size: var(--font-size-sm);
    color: var(--gray-600);
}

.admin-subject-progress {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.admin-progress-bar {
    flex: 1;
    height: 8px;
    background: var(--gray-200);
    border-radius: var(--radius);
    overflow: hidden;
}

.admin-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
    border-radius: var(--radius);
    transition: width 1s ease;
}

.admin-progress-text {
    font-size: var(--font-size-sm);
    font-weight: 600;
    color: var(--gray-700);
    min-width: 35px;
}

/* Statut système */
.admin-system-status {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-3);
}

.admin-status-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-3);
    border-radius: var(--radius);
    background: var(--gray-50);
}

.admin-status-service {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    font-weight: 500;
}

.admin-status-success { color: var(--admin-success); }
.admin-status-error { color: var(--admin-error); }
.admin-status-warning { color: var(--admin-warning); }

/* Actions rapides */
.admin-quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--spacing-4);
}

.admin-quick-action-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: var(--spacing-4);
    border-radius: var(--radius-lg);
    background: var(--gray-50);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.admin-quick-action-card:hover {
    background: var(--gray-100);
    transform: translateY(-2px);
}

.admin-quick-action-icon {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--font-size-lg);
    color: white;
    margin-bottom: var(--spacing-3);
}

.admin-icon-blue { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
.admin-icon-green { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
.admin-icon-purple { background: linear-gradient(135deg, #8b5cf6 0%, #5b21b6 100%); }
.admin-icon-orange { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }

.admin-quick-action-content h4 {
    font-weight: 600;
    margin-bottom: var(--spacing-1);
    color: var(--gray-800);
}

.admin-quick-action-content p {
    font-size: var(--font-size-sm);
    color: var(--gray-600);
}

/* Alertes section */
.admin-alerts-section {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-3);
}

/* Raccourcis */
.admin-shortcuts-section {
    margin-top: var(--spacing-8);
}

.admin-section-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    font-size: var(--font-size-2xl);
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: var(--spacing-6);
}

.admin-shortcuts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-6);
}

.admin-shortcut-card {
    background: white;
    padding: var(--spacing-6);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.admin-shortcut-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.admin-shortcut-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
}

.admin-shortcut-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-xl);
    background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: var(--font-size-xl);
    color: white;
    margin-bottom: var(--spacing-4);
}

.admin-shortcut-card h3 {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: var(--spacing-2);
}

.admin-shortcut-card p {
    color: var(--gray-600);
    margin-bottom: var(--spacing-4);
    line-height: 1.5;
}

.admin-shortcut-badge {
    background: var(--admin-primary);
    color: white;
    padding: var(--spacing-1) var(--spacing-3);
    border-radius: var(--radius-lg);
    font-size: var(--font-size-xs);
    font-weight: 600;
    display: inline-block;
}

/* Animation pour stats mises à jour */
@keyframes admin-stat-update {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); background: var(--admin-primary); color: white; }
    100% { transform: scale(1); }
}

.admin-stat-updated {
    animation: admin-stat-update 0.6s ease;
}

/* Responsive */
@media (max-width: 1024px) {
    .admin-dashboard-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-6);
    }
    
    .admin-quick-actions-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .admin-welcome-title {
        font-size: var(--font-size-2xl);
        flex-direction: column;
        text-align: center;
    }
    
    .admin-shortcuts-grid {
        grid-template-columns: 1fr;
    }
}
</style>