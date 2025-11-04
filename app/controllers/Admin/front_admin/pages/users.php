<?php
/**
 * GESTION DES UTILISATEURS - Interface d'administration
 */

// Configuration de la page
$page_title = "Gestion des utilisateurs";
$show_breadcrumbs = true;
$breadcrumbs = [
    ['title' => 'Gestion des utilisateurs']
];

// Inclusion des composants
require_once __DIR__ . '/../components/admin-components.php';

// Simulation de données utilisateurs (en production, récupération depuis la base)
$users = [
    [
        'id' => 1,
        'nom' => 'Dubois',
        'prenom' => 'Marie',
        'email' => 'marie.dubois@email.com',
        'role' => 'student',
        'niveau' => 'Terminale S',
        'date_inscription' => '2024-01-15',
        'derniere_connexion' => '2024-01-20 14:30:00',
        'statut' => 'active',
        'conversations' => 12,
        'messages' => 45
    ],
    [
        'id' => 2,
        'nom' => 'Martin',
        'prenom' => 'Lucas',
        'email' => 'lucas.martin@email.com',
        'role' => 'student',
        'niveau' => 'Première ES',
        'date_inscription' => '2024-01-10',
        'derniere_connexion' => '2024-01-20 09:15:00',
        'statut' => 'active',
        'conversations' => 8,
        'messages' => 32
    ],
    [
        'id' => 3,
        'nom' => 'Bernard',
        'prenom' => 'Sophie',
        'email' => 'sophie.bernard@email.com',
        'role' => 'teacher',
        'niveau' => 'Enseignant',
        'date_inscription' => '2024-01-05',
        'derniere_connexion' => '2024-01-19 16:45:00',
        'statut' => 'active',
        'conversations' => 25,
        'messages' => 120
    ],
    [
        'id' => 4,
        'nom' => 'Lefebvre',
        'prenom' => 'Antoine',
        'email' => 'antoine.lefebvre@email.com',
        'role' => 'student',
        'niveau' => 'Seconde',
        'date_inscription' => '2024-01-01',
        'derniere_connexion' => '2024-01-18 11:20:00',
        'statut' => 'inactive',
        'conversations' => 3,
        'messages' => 8
    ]
];

$stats_users = [
    'total' => count($users),
    'actifs' => count(array_filter($users, fn($u) => $u['statut'] === 'active')),
    'etudiants' => count(array_filter($users, fn($u) => $u['role'] === 'student')),
    'enseignants' => count(array_filter($users, fn($u) => $u['role'] === 'teacher'))
];

// Inclusion du header
require_once __DIR__ . '/../components/admin-header.php';
?>

<div class="admin-container">
    
    <!-- En-tête de section -->
    <div class="admin-page-header">
        <div class="admin-page-title-section">
            <h1 class="admin-page-title">
                <i class="fas fa-users"></i>
                Gestion des utilisateurs
            </h1>
            <p class="admin-page-description">
                Gérez les comptes utilisateurs, leurs rôles et leurs permissions. 
                Surveillez l'activité et modérez les accès à la plateforme.
            </p>
        </div>
        
        <div class="admin-page-actions">
            <?= admin_button('Nouvel utilisateur', '/admin/users/create', 'primary', 'fas fa-plus') ?>
            <?= admin_button('Exporter', '/admin/users/export', 'outline', 'fas fa-download') ?>
        </div>
    </div>
    
    <!-- Statistiques des utilisateurs -->
    <div class="admin-stats-grid admin-mb-8">
        <?= admin_stat_card('Total utilisateurs', $stats_users['total'], 'fas fa-users', 'red') ?>
        <?= admin_stat_card('Utilisateurs actifs', $stats_users['actifs'], 'fas fa-user-check', 'green') ?>
        <?= admin_stat_card('Étudiants', $stats_users['etudiants'], 'fas fa-graduation-cap', 'blue') ?>
        <?= admin_stat_card('Enseignants', $stats_users['enseignants'], 'fas fa-chalkboard-teacher', 'purple') ?>
    </div>
    
    <!-- Filtres et recherche -->
    <div class="admin-filters-section">
        <div class="admin-filters-row">
            <div class="admin-search-container">
                <i class="fas fa-search admin-search-icon"></i>
                <input type="text" 
                       class="admin-form-input admin-search-input" 
                       placeholder="Rechercher un utilisateur..."
                       data-target=".admin-users-table">
            </div>
            
            <div class="admin-filters-group">
                <?= admin_select('filter_role', [
                    '' => 'Tous les rôles',
                    'student' => 'Étudiants',
                    'teacher' => 'Enseignants',
                    'admin' => 'Administrateurs'
                ], '', ['class' => 'admin-filter-select']) ?>
                
                <?= admin_select('filter_status', [
                    '' => 'Tous les statuts',
                    'active' => 'Actifs',
                    'inactive' => 'Inactifs',
                    'suspended' => 'Suspendus'
                ], '', ['class' => 'admin-filter-select']) ?>
                
                <?= admin_button('Réinitialiser', '#', 'secondary', 'fas fa-undo', ['class' => 'admin-reset-filters']) ?>
            </div>
        </div>
    </div>
    
    <!-- Tableau des utilisateurs -->
    <div class="admin-users-table-container">
        <div class="admin-table-header">
            <h3 class="admin-table-title">
                <i class="fas fa-table"></i>
                Liste des utilisateurs
            </h3>
            <div class="admin-table-actions">
                <?= admin_button('Actions groupées', '#', 'outline', 'fas fa-tasks', [
                    'class' => 'admin-bulk-actions-trigger',
                    'data-modal' => 'bulk-actions-modal'
                ]) ?>
            </div>
        </div>
        
        <div class="admin-table-container">
            <table class="admin-table admin-users-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="admin-select-all"></th>
                        <th data-sort="text">Utilisateur</th>
                        <th data-sort="text">Email</th>
                        <th data-sort="text">Rôle</th>
                        <th data-sort="text">Niveau</th>
                        <th data-sort="date">Inscription</th>
                        <th data-sort="date">Dernière connexion</th>
                        <th data-sort="text">Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr data-searchable="<?= strtolower($user['nom'] . ' ' . $user['prenom'] . ' ' . $user['email'] . ' ' . $user['role']) ?>">
                        <td>
                            <input type="checkbox" class="admin-row-select" value="<?= $user['id'] ?>">
                        </td>
                        <td>
                            <div class="admin-user-info">
                                <div class="admin-user-avatar">
                                    <?= strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)) ?>
                                </div>
                                <div class="admin-user-details">
                                    <div class="admin-user-name">
                                        <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                                    </div>
                                    <div class="admin-user-id">ID: <?= $user['id'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($user['email']) ?>" class="admin-email-link">
                                <?= htmlspecialchars($user['email']) ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            $role_config = [
                                'student' => ['text' => 'Étudiant', 'class' => 'admin-badge-blue'],
                                'teacher' => ['text' => 'Enseignant', 'class' => 'admin-badge-green'],
                                'admin' => ['text' => 'Administrateur', 'class' => 'admin-badge-red']
                            ];
                            $role = $role_config[$user['role']] ?? ['text' => 'Inconnu', 'class' => 'admin-badge-gray'];
                            ?>
                            <span class="admin-badge <?= $role['class'] ?>"><?= $role['text'] ?></span>
                        </td>
                        <td><?= htmlspecialchars($user['niveau']) ?></td>
                        <td><?= date('d/m/Y', strtotime($user['date_inscription'])) ?></td>
                        <td>
                            <div class="admin-last-seen">
                                <?= date('d/m/Y H:i', strtotime($user['derniere_connexion'])) ?>
                                <div class="admin-time-ago">
                                    <?php
                                    $diff = time() - strtotime($user['derniere_connexion']);
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
                            <?= admin_status_indicator($user['statut'], 
                                $user['statut'] === 'active' ? 'Actif' : 'Inactif') ?>
                        </td>
                        <td>
                            <div class="admin-actions-group">
                                <a href="/admin/users/<?= $user['id'] ?>" 
                                   class="admin-action-btn admin-action-view"
                                   title="Voir le profil">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="/admin/users/<?= $user['id'] ?>/edit" 
                                   class="admin-action-btn admin-action-edit"
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button class="admin-action-btn admin-action-message"
                                        title="Envoyer un message"
                                        data-user-id="<?= $user['id'] ?>"
                                        data-user-name="<?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                
                                <button class="admin-action-btn admin-action-delete admin-btn-delete"
                                        title="Supprimer"
                                        data-delete-url="/admin/users/<?= $user['id'] ?>/delete"
                                        data-item-name="<?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>">
                                    <i class="fas fa-trash"></i>
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
                Affichage de 1 à <?= count($users) ?> sur <?= count($users) ?> utilisateurs
            </div>
            <?= admin_pagination(1, 1, '/admin/users') ?>
        </div>
    </div>
    
</div>

<!-- Modal Actions groupées -->
<?= admin_modal('bulk-actions-modal', 'Actions groupées', '
    <div class="admin-bulk-actions">
        <p class="admin-mb-4">Sélectionnez une action à appliquer aux utilisateurs sélectionnés :</p>
        
        <div class="admin-bulk-action-list">
            <button class="admin-bulk-action-btn" data-action="activate">
                <i class="fas fa-check-circle"></i>
                Activer les utilisateurs
            </button>
            
            <button class="admin-bulk-action-btn" data-action="deactivate">
                <i class="fas fa-times-circle"></i>
                Désactiver les utilisateurs
            </button>
            
            <button class="admin-bulk-action-btn" data-action="send-message">
                <i class="fas fa-envelope"></i>
                Envoyer un message groupé
            </button>
            
            <button class="admin-bulk-action-btn admin-bulk-action-danger" data-action="delete">
                <i class="fas fa-trash"></i>
                Supprimer les utilisateurs
            </button>
        </div>
        
        <div class="admin-mt-6 admin-text-center">
            ' . admin_button('Annuler', '#', 'secondary admin-modal-close') . '
        </div>
    </div>
') ?>

<?php
// Scripts spécifiques à cette page
$inline_scripts = "
    // Gestion de la sélection multiple
    document.querySelector('.admin-select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.admin-row-select');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkActionsButton();
    });
    
    document.querySelectorAll('.admin-row-select').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionsButton);
    });
    
    function updateBulkActionsButton() {
        const selected = document.querySelectorAll('.admin-row-select:checked');
        const bulkBtn = document.querySelector('.admin-bulk-actions-trigger');
        
        if (selected.length > 0) {
            bulkBtn.textContent = `Actions (${selected.length} sélectionnés)`;
            bulkBtn.classList.remove('admin-btn-outline');
            bulkBtn.classList.add('admin-btn-primary');
        } else {
            bulkBtn.textContent = 'Actions groupées';
            bulkBtn.classList.add('admin-btn-outline');
            bulkBtn.classList.remove('admin-btn-primary');
        }
    }
    
    // Filtres en temps réel
    document.querySelectorAll('.admin-filter-select').forEach(filter => {
        filter.addEventListener('change', function() {
            applyFilters();
        });
    });
    
    function applyFilters() {
        const roleFilter = document.querySelector('[name=\"filter_role\"]').value;
        const statusFilter = document.querySelector('[name=\"filter_status\"]').value;
        const rows = document.querySelectorAll('.admin-users-table tbody tr');
        
        rows.forEach(row => {
            const roleCell = row.querySelector('td:nth-child(4) .admin-badge').textContent.trim();
            const statusCell = row.querySelector('td:nth-child(8)').textContent.trim();
            
            let showRow = true;
            
            if (roleFilter && !roleCell.toLowerCase().includes(roleFilter)) {
                showRow = false;
            }
            
            if (statusFilter && !statusCell.toLowerCase().includes(statusFilter)) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
    
    // Réinitialisation des filtres
    document.querySelector('.admin-reset-filters').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.admin-filter-select').forEach(filter => {
            filter.value = '';
        });
        document.querySelector('.admin-search-input').value = '';
        applyFilters();
        window.adminApp.performSearch('', '.admin-users-table');
    });
    
    // Gestion des actions groupées
    document.querySelectorAll('.admin-bulk-action-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            const selected = Array.from(document.querySelectorAll('.admin-row-select:checked')).map(cb => cb.value);
            
            if (selected.length === 0) {
                window.adminApp.showNotification('Aucun utilisateur sélectionné', 'warning');
                return;
            }
            
            performBulkAction(action, selected);
        });
    });
    
    function performBulkAction(action, userIds) {
        const messages = {
            activate: 'Activer ces utilisateurs ?',
            deactivate: 'Désactiver ces utilisateurs ?',
            'send-message': 'Composer un message pour ces utilisateurs ?',
            delete: 'Supprimer définitivement ces utilisateurs ?'
        };
        
        if (confirm(`${messages[action]} (${userIds.length} utilisateurs)`)) {
            window.adminApp.showNotification(`Action \"${action}\" en cours...`, 'info');
            window.adminApp.closeModal();
            
            // Simulation d'une requête AJAX
            setTimeout(() => {
                window.adminApp.showNotification(`Action exécutée avec succès`, 'success');
            }, 1500);
        }
    }
";

// Inclusion du footer
require_once __DIR__ . '/../components/admin-footer.php';
?>

<style>
/* Styles spécifiques à la page utilisateurs */
.admin-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-8);
    padding-bottom: var(--spacing-6);
    border-bottom: 2px solid var(--gray-200);
}

.admin-page-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    font-size: var(--font-size-3xl);
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: var(--spacing-2);
}

.admin-page-description {
    color: var(--gray-600);
    font-size: var(--font-size-lg);
    line-height: 1.6;
    max-width: 600px;
}

.admin-page-actions {
    display: flex;
    gap: var(--spacing-3);
    flex-shrink: 0;
}

/* Filtres */
.admin-filters-section {
    background: white;
    padding: var(--spacing-6);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    margin-bottom: var(--spacing-6);
}

.admin-filters-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--spacing-6);
}

.admin-search-container {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.admin-search-icon {
    position: absolute;
    left: var(--spacing-4);
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    z-index: 1;
}

.admin-search-input {
    padding-left: calc(var(--spacing-4) + 20px + var(--spacing-3));
}

.admin-filters-group {
    display: flex;
    gap: var(--spacing-3);
    align-items: center;
}

/* Tableau des utilisateurs */
.admin-users-table-container {
    background: white;
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.admin-table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-6);
    border-bottom: 1px solid var(--gray-200);
    background: var(--gray-50);
}

.admin-table-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

/* Informations utilisateur */
.admin-user-info {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.admin-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-primary-hover) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: var(--font-size-sm);
}

.admin-user-details {
    display: flex;
    flex-direction: column;
}

.admin-user-name {
    font-weight: 600;
    color: var(--gray-800);
}

.admin-user-id {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
}

.admin-email-link {
    color: var(--admin-primary);
    text-decoration: none;
}

.admin-email-link:hover {
    text-decoration: underline;
}

/* Badges */
.admin-badge {
    padding: var(--spacing-1) var(--spacing-3);
    border-radius: var(--radius-lg);
    font-size: var(--font-size-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.admin-badge-blue {
    background: #dbeafe;
    color: #1e40af;
}

.admin-badge-green {
    background: #dcfdf7;
    color: #065f46;
}

.admin-badge-red {
    background: #fee2e2;
    color: #991b1b;
}

.admin-badge-gray {
    background: var(--gray-200);
    color: var(--gray-700);
}

/* Dernière connexion */
.admin-last-seen {
    display: flex;
    flex-direction: column;
}

.admin-time-ago {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
    font-style: italic;
}

/* Actions */
.admin-actions-group {
    display: flex;
    gap: var(--spacing-2);
}

.admin-action-btn {
    width: 32px;
    height: 32px;
    border-radius: var(--radius);
    border: none;
    background: var(--gray-100);
    color: var(--gray-600);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.admin-action-btn:hover {
    background: var(--gray-200);
    color: var(--gray-800);
    transform: translateY(-1px);
}

.admin-action-view:hover {
    background: #dbeafe;
    color: #1e40af;
}

.admin-action-edit:hover {
    background: #dcfdf7;
    color: #065f46;
}

.admin-action-message:hover {
    background: #fef3c7;
    color: #92400e;
}

.admin-action-delete:hover {
    background: #fee2e2;
    color: #991b1b;
}

/* Footer du tableau */
.admin-table-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-4) var(--spacing-6);
    background: var(--gray-50);
    border-top: 1px solid var(--gray-200);
}

.admin-table-info {
    color: var(--gray-600);
    font-size: var(--font-size-sm);
}

/* Actions groupées */
.admin-bulk-actions {
    text-align: center;
}

.admin-bulk-action-list {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-3);
    margin: var(--spacing-6) 0;
}

.admin-bulk-action-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-4);
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-lg);
    background: white;
    color: var(--gray-700);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}

.admin-bulk-action-btn:hover {
    border-color: var(--admin-primary);
    background: var(--admin-primary);
    color: white;
}

.admin-bulk-action-danger:hover {
    border-color: var(--admin-error);
    background: var(--admin-error);
    color: white;
}

/* Pagination */
.admin-pagination {
    display: flex;
    gap: var(--spacing-2);
    align-items: center;
}

.admin-pagination-btn,
.admin-pagination-num {
    padding: var(--spacing-2) var(--spacing-4);
    border-radius: var(--radius);
    text-decoration: none;
    color: var(--gray-600);
    background: white;
    border: 1px solid var(--gray-300);
    transition: all 0.3s ease;
}

.admin-pagination-btn:hover,
.admin-pagination-num:hover {
    background: var(--gray-50);
    color: var(--gray-800);
}

.admin-pagination-num.active {
    background: var(--admin-primary);
    color: white;
    border-color: var(--admin-primary);
}

.admin-pagination-dots {
    color: var(--gray-400);
    padding: var(--spacing-2);
}

/* Responsive */
@media (max-width: 1024px) {
    .admin-page-header {
        flex-direction: column;
        gap: var(--spacing-4);
    }
    
    .admin-filters-row {
        flex-direction: column;
        gap: var(--spacing-4);
    }
    
    .admin-search-container {
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .admin-table-container {
        overflow-x: auto;
    }
    
    .admin-users-table {
        min-width: 800px;
    }
    
    .admin-page-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .admin-table-footer {
        flex-direction: column;
        gap: var(--spacing-3);
        text-align: center;
    }
}
</style>