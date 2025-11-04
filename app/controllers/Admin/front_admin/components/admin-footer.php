    </main>
    
    <!-- Footer Admin -->
    <footer class="admin-footer">
        <div class="admin-container">
            <div class="admin-footer-content">
                
                <!-- Informations système -->
                <div class="admin-footer-section">
                    <h4 class="admin-footer-title">
                        <i class="fas fa-server"></i>
                        Système
                    </h4>
                    <div class="admin-footer-info">
                        <div class="admin-info-item">
                            <span class="admin-info-label">Version :</span>
                            <span class="admin-info-value">School Agent v2.0</span>
                        </div>
                        <div class="admin-info-item">
                            <span class="admin-info-label">Dernière MAJ :</span>
                            <span class="admin-info-value"><?= date('d/m/Y') ?></span>
                        </div>
                        <div class="admin-info-item">
                            <span class="admin-info-label">Statut :</span>
                            <span class="admin-status-online">
                                <i class="fas fa-circle"></i>
                                En ligne
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques rapides -->
                <div class="admin-footer-section">
                    <h4 class="admin-footer-title">
                        <i class="fas fa-chart-bar"></i>
                        Statistiques du jour
                    </h4>
                    <div class="admin-footer-stats">
                        <?php
                        // Récupération des stats du jour (simulation)
                        $today_stats = [
                            'connexions' => 24,
                            'messages' => 156,
                            'nouveaux_users' => 3
                        ];
                        ?>
                        <div class="admin-stat-item">
                            <i class="fas fa-sign-in-alt"></i>
                            <span><?= $today_stats['connexions'] ?> connexions</span>
                        </div>
                        <div class="admin-stat-item">
                            <i class="fas fa-envelope"></i>
                            <span><?= $today_stats['messages'] ?> messages</span>
                        </div>
                        <div class="admin-stat-item">
                            <i class="fas fa-user-plus"></i>
                            <span><?= $today_stats['nouveaux_users'] ?> nouveaux</span>
                        </div>
                    </div>
                </div>
                
                <!-- Actions rapides -->
                <div class="admin-footer-section">
                    <h4 class="admin-footer-title">
                        <i class="fas fa-bolt"></i>
                        Actions rapides
                    </h4>
                    <div class="admin-quick-actions">
                        <a href="/admin/users/create" class="admin-quick-action">
                            <i class="fas fa-user-plus"></i>
                            Ajouter utilisateur
                        </a>
                        <a href="/admin/backup" class="admin-quick-action">
                            <i class="fas fa-download"></i>
                            Sauvegarde
                        </a>
                        <a href="/admin/logs" class="admin-quick-action">
                            <i class="fas fa-file-alt"></i>
                            Voir les logs
                        </a>
                        <a href="/admin/settings" class="admin-quick-action">
                            <i class="fas fa-cog"></i>
                            Paramètres
                        </a>
                    </div>
                </div>
                
                <!-- Heure et utilisateur connecté -->
                <div class="admin-footer-section">
                    <h4 class="admin-footer-title">
                        <i class="fas fa-clock"></i>
                        Session
                    </h4>
                    <div class="admin-session-info">
                        <div class="admin-clock">
                            <?= date('H:i') ?>
                        </div>
                        <div class="admin-date">
                            <?= date('d/m/Y') ?>
                        </div>
                        <div class="admin-user-info">
                            <i class="fas fa-user-shield"></i>
                            Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user_prenom'] ?? 'Admin') ?></strong>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Copyright -->
            <div class="admin-footer-bottom">
                <div class="admin-copyright">
                    <span>&copy; <?= date('Y') ?> School Agent Administration</span>
                    <span>•</span>
                    <span>Développé avec ❤️ pour l'éducation</span>
                </div>
                
                <div class="admin-footer-links">
                    <a href="/admin/help" class="admin-footer-link">
                        <i class="fas fa-question-circle"></i>
                        Aide
                    </a>
                    <a href="/admin/support" class="admin-footer-link">
                        <i class="fas fa-life-ring"></i>
                        Support
                    </a>
                    <a href="/admin/docs" class="admin-footer-link">
                        <i class="fas fa-book"></i>
                        Documentation
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Admin JavaScript -->
    <script src="/app/front_admin/js/admin-app.js"></script>
    
    <!-- Scripts spécifiques à la page -->
    <?php if (isset($page_scripts) && is_array($page_scripts)): ?>
        <?php foreach ($page_scripts as $script): ?>
            <script src="<?= htmlspecialchars($script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Inline scripts -->
    <?php if (isset($inline_scripts)): ?>
        <script>
            <?= $inline_scripts ?>
        </script>
    <?php endif; ?>

</body>
</html>

<style>
/* Styles pour le footer admin */
.admin-footer {
    background: var(--gray-800);
    color: var(--gray-200);
    padding: var(--spacing-8) 0 var(--spacing-4);
    margin-top: auto;
    border-top: 3px solid var(--admin-primary);
}

.admin-footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-8);
    margin-bottom: var(--spacing-6);
}

.admin-footer-section h4.admin-footer-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    color: white;
    font-size: var(--font-size-lg);
    font-weight: 600;
    margin-bottom: var(--spacing-4);
    padding-bottom: var(--spacing-2);
    border-bottom: 2px solid var(--admin-primary);
}

.admin-footer-info .admin-info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-2) 0;
    border-bottom: 1px solid var(--gray-700);
}

.admin-info-label {
    color: var(--gray-400);
    font-size: var(--font-size-sm);
}

.admin-info-value {
    color: var(--gray-200);
    font-weight: 500;
}

.admin-status-online {
    color: var(--admin-success);
    display: flex;
    align-items: center;
    gap: var(--spacing-1);
    font-weight: 500;
}

.admin-status-online i {
    animation: admin-pulse 2s infinite;
}

/* Stats du footer */
.admin-footer-stats {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-3);
}

.admin-stat-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-2);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    transition: all 0.3s ease;
}

.admin-stat-item:hover {
    background: rgba(255, 255, 255, 0.1);
}

.admin-stat-item i {
    color: var(--admin-primary);
    width: 20px;
    text-align: center;
}

/* Actions rapides */
.admin-quick-actions {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-2);
}

.admin-quick-action {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
    padding: var(--spacing-3);
    color: var(--gray-300);
    text-decoration: none;
    border-radius: var(--radius);
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    font-size: var(--font-size-sm);
}

.admin-quick-action:hover {
    background: var(--admin-primary);
    color: white;
    transform: translateX(5px);
}

.admin-quick-action i {
    width: 16px;
    text-align: center;
}

/* Informations de session */
.admin-session-info {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-3);
}

.admin-clock {
    font-size: var(--font-size-2xl);
    font-weight: 700;
    color: var(--admin-primary);
    text-align: center;
    padding: var(--spacing-2);
    background: rgba(220, 38, 38, 0.1);
    border-radius: var(--radius-lg);
}

.admin-date {
    text-align: center;
    color: var(--gray-400);
    font-size: var(--font-size-sm);
}

.admin-user-info {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    padding: var(--spacing-3);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    font-size: var(--font-size-sm);
}

.admin-user-info i {
    color: var(--admin-primary);
}

/* Footer bottom */
.admin-footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--spacing-6);
    border-top: 1px solid var(--gray-700);
    flex-wrap: wrap;
    gap: var(--spacing-4);
}

.admin-copyright {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    color: var(--gray-400);
    font-size: var(--font-size-sm);
}

.admin-footer-links {
    display: flex;
    align-items: center;
    gap: var(--spacing-4);
}

.admin-footer-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-2);
    color: var(--gray-400);
    text-decoration: none;
    font-size: var(--font-size-sm);
    transition: all 0.3s ease;
}

.admin-footer-link:hover {
    color: var(--admin-primary);
}

/* Responsive */
@media (max-width: 768px) {
    .admin-footer-content {
        grid-template-columns: 1fr;
        gap: var(--spacing-6);
    }
    
    .admin-footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-3);
    }
    
    .admin-copyright {
        flex-direction: column;
        gap: var(--spacing-1);
    }
}

/* Animation pour les stats en temps réel */
@keyframes admin-counter-update {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); color: var(--admin-primary); }
    100% { transform: scale(1); }
}

.admin-stat-item.updated {
    animation: admin-counter-update 0.5s ease;
}
</style>

<script>
// Mise à jour de l'heure en temps réel
setInterval(function() {
    const clockElement = document.querySelector('.admin-clock');
    if (clockElement) {
        const now = new Date();
        const timeString = now.toLocaleTimeString('fr-FR', {
            hour: '2-digit',
            minute: '2-digit'
        });
        clockElement.textContent = timeString;
    }
}, 60000);

// Animation des nouvelles statistiques
function updateStat(element, newValue) {
    element.textContent = newValue;
    element.closest('.admin-stat-item').classList.add('updated');
    
    setTimeout(() => {
        element.closest('.admin-stat-item').classList.remove('updated');
    }, 500);
}

// Simulation de mise à jour des stats (en production, cela viendrait d'une API)
setInterval(function() {
    // Simulation d'une nouvelle connexion
    if (Math.random() > 0.9) {
        const connectionsElement = document.querySelector('.admin-stat-item:first-child span');
        if (connectionsElement) {
            const currentValue = parseInt(connectionsElement.textContent);
            updateStat(connectionsElement, (currentValue + 1) + ' connexions');
        }
    }
}, 30000);
</script>