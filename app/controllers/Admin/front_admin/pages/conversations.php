<?php
/**
 * GESTION DES CONVERSATIONS - Interface d'administration
 */

// Configuration de la page
$page_title = "Gestion des conversations";
$show_breadcrumbs = true;
$breadcrumbs = [
    ['title' => 'Gestion des conversations']
];

// Inclusion des composants
require_once __DIR__ . '/../components/admin-components.php';

// Simulation de données conversations (en production, récupération depuis la base)
$conversations = [
    [
        'id' => 1,
        'utilisateur' => 'Marie Dubois',
        'agent' => 'Agent Mathéo',
        'sujet' => 'Aide aux équations du second degré',
        'messages_count' => 15,
        'date_creation' => '2024-01-20 10:30:00',
        'derniere_activite' => '2024-01-20 14:30:00',
        'statut' => 'active',
        'niveau' => 'Terminale S',
        'matiere' => 'Mathématiques'
    ],
    [
        'id' => 2,
        'utilisateur' => 'Lucas Martin',
        'agent' => 'Agent Histoire',
        'sujet' => 'La Révolution française',
        'messages_count' => 8,
        'date_creation' => '2024-01-20 09:15:00',
        'derniere_activite' => '2024-01-20 12:45:00',
        'statut' => 'completed',
        'niveau' => 'Première ES',
        'matiere' => 'Histoire'
    ],
    [
        'id' => 3,
        'utilisateur' => 'Sophie Bernard',
        'agent' => 'Agent Scolaire',
        'sujet' => 'Méthodes de révision efficaces',
        'messages_count' => 25,
        'date_creation' => '2024-01-19 16:45:00',
        'derniere_activite' => '2024-01-20 11:20:00',
        'statut' => 'active',
        'niveau' => 'Enseignant',
        'matiere' => 'Méthodologie'
    ],
    [
        'id' => 4,
        'utilisateur' => 'Antoine Lefebvre',
        'agent' => 'Agent Mathéo',
        'sujet' => 'Théorème de Pythagore',
        'messages_count' => 3,
        'date_creation' => '2024-01-18 11:20:00',
        'derniere_activite' => '2024-01-18 11:35:00',
        'statut' => 'archived',
        'niveau' => 'Seconde',
        'matiere' => 'Mathématiques'
    ]
];

$stats_conversations = [
    'total' => count($conversations),
    'actives' => count(array_filter($conversations, fn($c) => $c['statut'] === 'active')),
    'completees' => count(array_filter($conversations, fn($c) => $c['statut'] === 'completed')),
    'archivees' => count(array_filter($conversations, fn($c) => $c['statut'] === 'archived'))
];

$agents_stats = [
    'Agent Mathéo' => ['conversations' => 2, 'color' => 'blue'],
    'Agent Histoire' => ['conversations' => 1, 'color' => 'green'],
    'Agent Scolaire' => ['conversations' => 1, 'color' => 'purple']
];

// Inclusion du header
require_once __DIR__ . '/../components/admin-header.php';
?>

<div class="admin-container">
    
    <!-- En-tête de section -->
    <div class="admin-page-header">
        <div class="admin-page-title-section">
            <h1 class="admin-page-title">
                <i class="fas fa-comments"></i>
                Gestion des conversations
            </h1>
            <p class="admin-page-description">
                Surveillez et modérez les conversations entre utilisateurs et agents IA. 
                Analysez les performances et identifiez les tendances pédagogiques.
            </p>
        </div>
        
        <div class="admin-page-actions">
            <?= admin_button('Nouvelle conversation', '/admin/conversations/create', 'primary', 'fas fa-plus') ?>
            <?= admin_button('Rapports', '/admin/conversations/reports', 'outline', 'fas fa-chart-bar') ?>
        </div>
    </div>
    
    <!-- Statistiques des conversations -->
    <div class="admin-stats-grid admin-mb-8">
        <?= admin_stat_card('Total conversations', $stats_conversations['total'], 'fas fa-comments', 'green') ?>
        <?= admin_stat_card('Conversations actives', $stats_conversations['actives'], 'fas fa-play-circle', 'blue') ?>
        <?= admin_stat_card('Conversations terminées', $stats_conversations['completees'], 'fas fa-check-circle', 'green') ?>
        <?= admin_stat_card('Conversations archivées', $stats_conversations['archivees'], 'fas fa-archive', 'purple') ?>
    </div>
    
    <!-- Grille des agents -->
    <div class="admin-agents-section admin-mb-8">
        <h2 class="admin-section-title">
            <i class="fas fa-robot"></i>
            Performance des agents IA
        </h2>
        
        <div class="admin-agents-grid">
            <?php foreach ($agents_stats as $agent_name => $stats): ?>
            <div class="admin-agent-card">
                <div class="admin-agent-avatar agent-avatar-<?= $stats['color'] ?>">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="admin-agent-info">
                    <h3 class="admin-agent-name"><?= $agent_name ?></h3>
                    <div class="admin-agent-stats">
                        <div class="admin-agent-stat">
                            <span class="admin-agent-stat-number"><?= $stats['conversations'] ?></span>
                            <span class="admin-agent-stat-label">conversations</span>
                        </div>
                    </div>
                </div>
                <div class="admin-agent-actions">
                    <a href="/admin/agents/<?= urlencode($agent_name) ?>" class="admin-agent-action">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/admin/agents/<?= urlencode($agent_name) ?>/settings" class="admin-agent-action">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Filtres et recherche -->
    <div class="admin-filters-section">
        <div class="admin-filters-row">
            <div class="admin-search-container">
                <i class="fas fa-search admin-search-icon"></i>
                <input type="text" 
                       class="admin-form-input admin-search-input" 
                       placeholder="Rechercher une conversation..."
                       data-target=".admin-conversations-table">
            </div>
            
            <div class="admin-filters-group">
                <?= admin_select('filter_agent', [
                    '' => 'Tous les agents',
                    'Agent Mathéo' => 'Agent Mathéo',
                    'Agent Histoire' => 'Agent Histoire',
                    'Agent Scolaire' => 'Agent Scolaire'
                ], '', ['class' => 'admin-filter-select']) ?>
                
                <?= admin_select('filter_status', [
                    '' => 'Tous les statuts',
                    'active' => 'Actives',
                    'completed' => 'Terminées',
                    'archived' => 'Archivées'
                ], '', ['class' => 'admin-filter-select']) ?>
                
                <?= admin_select('filter_matiere', [
                    '' => 'Toutes les matières',
                    'Mathématiques' => 'Mathématiques',
                    'Histoire' => 'Histoire',
                    'Méthodologie' => 'Méthodologie'
                ], '', ['class' => 'admin-filter-select']) ?>
                
                <?= admin_button('Réinitialiser', '#', 'secondary', 'fas fa-undo', ['class' => 'admin-reset-filters']) ?>
            </div>
        </div>
    </div>
    
    <!-- Tableau des conversations -->
    <div class="admin-conversations-table-container">
        <div class="admin-table-header">
            <h3 class="admin-table-title">
                <i class="fas fa-table"></i>
                Liste des conversations
            </h3>
            <div class="admin-table-actions">
                <?= admin_button('Exporter', '/admin/conversations/export', 'outline', 'fas fa-download') ?>
            </div>
        </div>
        
        <div class="admin-table-container">
            <table class="admin-table admin-conversations-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="admin-select-all"></th>
                        <th data-sort="text">Conversation</th>
                        <th data-sort="text">Utilisateur</th>
                        <th data-sort="text">Agent</th>
                        <th data-sort="text">Matière</th>
                        <th data-sort="number">Messages</th>
                        <th data-sort="date">Créée le</th>
                        <th data-sort="date">Dernière activité</th>
                        <th data-sort="text">Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conversations as $conv): ?>
                    <tr data-searchable="<?= strtolower($conv['sujet'] . ' ' . $conv['utilisateur'] . ' ' . $conv['agent'] . ' ' . $conv['matiere']) ?>">
                        <td>
                            <input type="checkbox" class="admin-row-select" value="<?= $conv['id'] ?>">
                        </td>
                        <td>
                            <div class="admin-conversation-info">
                                <div class="admin-conversation-subject">
                                    <?= htmlspecialchars($conv['sujet']) ?>
                                </div>
                                <div class="admin-conversation-meta">
                                    ID: <?= $conv['id'] ?> • <?= htmlspecialchars($conv['niveau']) ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="admin-user-mini">
                                <div class="admin-user-mini-avatar">
                                    <?= strtoupper(substr($conv['utilisateur'], 0, 1)) ?>
                                </div>
                                <span><?= htmlspecialchars($conv['utilisateur']) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="admin-agent-mini">
                                <?php
                                $agent_colors = [
                                    'Agent Mathéo' => 'blue',
                                    'Agent Histoire' => 'green', 
                                    'Agent Scolaire' => 'purple'
                                ];
                                $color = $agent_colors[$conv['agent']] ?? 'gray';
                                ?>
                                <div class="admin-agent-mini-icon agent-mini-<?= $color ?>">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <span><?= htmlspecialchars($conv['agent']) ?></span>
                            </div>
                        </td>
                        <td>
                            <?php
                            $matiere_colors = [
                                'Mathématiques' => 'admin-badge-blue',
                                'Histoire' => 'admin-badge-green',
                                'Méthodologie' => 'admin-badge-purple'
                            ];
                            $badge_color = $matiere_colors[$conv['matiere']] ?? 'admin-badge-gray';
                            ?>
                            <span class="admin-badge <?= $badge_color ?>"><?= htmlspecialchars($conv['matiere']) ?></span>
                        </td>
                        <td>
                            <div class="admin-messages-count">
                                <span class="admin-count-number"><?= $conv['messages_count'] ?></span>
                                <span class="admin-count-label">messages</span>
                            </div>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($conv['date_creation'])) ?></td>
                        <td>
                            <div class="admin-last-activity">
                                <?= date('d/m/Y H:i', strtotime($conv['derniere_activite'])) ?>
                                <div class="admin-time-ago">
                                    <?php
                                    $diff = time() - strtotime($conv['derniere_activite']);
                                    if ($diff < 3600) {
                                        echo 'Il y a ' . floor($diff / 60) . ' min';
                                    } elseif ($diff < 86400) {
                                        echo 'Il y a ' . floor($diff / 3600) . 'h';
                                    } else {
                                        echo 'Il y a ' . floor($diff / 86400) . 'j';
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php
                            $status_config = [
                                'active' => ['text' => 'Active', 'color' => 'success'],
                                'completed' => ['text' => 'Terminée', 'color' => 'info'],
                                'archived' => ['text' => 'Archivée', 'color' => 'warning']
                            ];
                            $status = $status_config[$conv['statut']] ?? ['text' => 'Inconnu', 'color' => 'error'];
                            ?>
                            <?= admin_status_indicator($conv['statut'], $status['text']) ?>
                        </td>
                        <td>
                            <div class="admin-actions-group">
                                <a href="/admin/conversations/<?= $conv['id'] ?>" 
                                   class="admin-action-btn admin-action-view"
                                   title="Voir la conversation">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="/admin/conversations/<?= $conv['id'] ?>/transcript" 
                                   class="admin-action-btn admin-action-transcript"
                                   title="Télécharger le transcript">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                
                                <button class="admin-action-btn admin-action-moderate"
                                        title="Modérer la conversation"
                                        data-conversation-id="<?= $conv['id'] ?>">
                                    <i class="fas fa-gavel"></i>
                                </button>
                                
                                <button class="admin-action-btn admin-action-archive"
                                        title="Archiver"
                                        data-conversation-id="<?= $conv['id'] ?>">
                                    <i class="fas fa-archive"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="admin-table-footer">
            <div class="admin-table-info">
                Affichage de 1 à <?= count($conversations) ?> sur <?= count($conversations) ?> conversations
            </div>
            <?= admin_pagination(1, 1, '/admin/conversations') ?>
        </div>
    </div>
    
</div>

<?php
// Scripts spécifiques à cette page
$page_scripts = ['/app/front_admin/js/conversations.js'];

// Inclusion du footer
require_once __DIR__ . '/../components/admin-footer.php';
?>

<style>
/* Styles spécifiques aux conversations */
.admin-agents-section {
    background: white;
    padding: var(--spacing-8);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
}

.admin-section-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--gray-800);
    margin-bottom: var(--spacing-6);
}

.admin-agents-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-6);
}

.admin-agent-card {
    display: flex;
    align-items: center;
    gap: var(--spacing-4);
    padding: var(--spacing-6);
    background: var(--gray-50);
    border-radius: var(--radius-xl);
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.admin-agent-card:hover {
    border-color: var(--admin-primary);
    background: white;
    box-shadow: var(--shadow-md);
}

.admin-agent-avatar {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: var(--font-size-xl);
}

.agent-avatar-blue {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}

.agent-avatar-green {
    background: linear-gradient(135deg, #10b981 0%, #047857 100%);
}

.agent-avatar-purple {
    background: linear-gradient(135deg, #8b5cf6 0%, #5b21b6 100%);
}

.admin-agent-info {
    flex: 1;
}

.admin-agent-name {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: var(--spacing-2);
}

.admin-agent-stats {
    display: flex;
    gap: var(--spacing-4);
}

.admin-agent-stat {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.admin-agent-stat-number {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--admin-primary);
}

.admin-agent-stat-label {
    font-size: var(--font-size-xs);
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.admin-agent-actions {
    display: flex;
    gap: var(--spacing-2);
}

.admin-agent-action {
    width: 36px;
    height: 36px;
    border-radius: var(--radius);
    background: white;
    border: 1px solid var(--gray-300);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-600);
    text-decoration: none;
    transition: all 0.3s ease;
}

.admin-agent-action:hover {
    background: var(--admin-primary);
    color: white;
    border-color: var(--admin-primary);
}

/* Informations conversation */
.admin-conversation-info {
    display: flex;
    flex-direction: column;
}

.admin-conversation-subject {
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: var(--spacing-1);
}

.admin-conversation-meta {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
}

/* Mini utilisateur */
.admin-user-mini {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
}

.admin-user-mini-avatar {
    width: 28px;
    height: 28px;
    border-radius: var(--radius);
    background: var(--admin-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: var(--font-size-xs);
    font-weight: 600;
}

/* Mini agent */
.admin-agent-mini {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
}

.admin-agent-mini-icon {
    width: 28px;
    height: 28px;
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: var(--font-size-xs);
}

.agent-mini-blue {
    background: #3b82f6;
}

.agent-mini-green {
    background: #10b981;
}

.agent-mini-purple {
    background: #8b5cf6;
}

/* Compteur de messages */
.admin-messages-count {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.admin-count-number {
    font-size: var(--font-size-lg);
    font-weight: 700;
    color: var(--admin-primary);
}

.admin-count-label {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
}

/* Dernière activité */
.admin-last-activity {
    display: flex;
    flex-direction: column;
}

.admin-time-ago {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
    font-style: italic;
}

/* Badges spécialisés */
.admin-badge-purple {
    background: #ede9fe;
    color: #5b21b6;
}

/* Actions spécialisées */
.admin-action-transcript:hover {
    background: #fef3c7;
    color: #92400e;
}

.admin-action-moderate:hover {
    background: #fee2e2;
    color: #991b1b;
}

.admin-action-archive:hover {
    background: #ede9fe;
    color: #5b21b6;
}

/* Responsive */
@media (max-width: 1024px) {
    .admin-agents-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .admin-agent-card {
        flex-direction: column;
        text-align: center;
    }
    
    .admin-conversations-table {
        min-width: 900px;
    }
}
</style>