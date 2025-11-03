<?php 
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/../front/components/FrontendComponents.php';

// Récupérer les agents disponibles pour l'affichage avec le nombre d'utilisateurs
use SchoolAgent\Config\Database;

$db = Database::getConnection();
$stmt = $db->query("
    SELECT 
        a.*,
        COUNT(DISTINCT c.id_user) as nb_utilisateurs
    FROM agent a
    LEFT JOIN conversation c ON a.id_agent = c.id_agent
    GROUP BY a.id_agent
    ORDER BY a.id_agent
");
$agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer quelques statistiques
$statsStmt = $db->query("
    SELECT 
        (SELECT COUNT(*) FROM utilisateur) as total_users,
        (SELECT COUNT(*) FROM conversation) as total_conversations,
        (SELECT COUNT(*) FROM message) as total_messages,
        (SELECT COUNT(*) FROM agent) as total_agents
");
$stats = $statsStmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="fade-in">
    <!-- Hero Section -->
    <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">🎓 Bienvenue sur School Agent</h1>
        <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 2rem;">
            Votre assistant IA personnel pour l'apprentissage et l'accompagnement scolaire
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/public/?page=conversation" class="btn btn-primary" style="background: white; color: var(--primary-color);">
                💬 Commencer une conversation
            </a>
            <a href="/public/?page=subject" class="btn btn-secondary" style="background: rgba(255,255,255,0.2); color: white; border: 2px solid white;">
                📚 Explorer les matières
            </a>
        </div>
    </div>

    <!-- Statistiques modernes -->
    <div class="grid grid-4" style="margin-bottom: 3rem;">
        <div class="stat-card">
            <div class="stat-number" style="color: var(--primary-color);"><?= $stats['total_agents'] ?></div>
            <div class="stat-label">Agents IA Spécialisés</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" style="color: var(--success-color);"><?= $stats['total_users'] ?></div>
            <div class="stat-label">Utilisateurs Actifs</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" style="color: var(--warning-color);"><?= $stats['total_conversations'] ?></div>
            <div class="stat-label">Conversations</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" style="color: var(--danger-color);"><?= $stats['total_messages'] ?></div>
            <div class="stat-label">Messages Échangés</div>
        </div>
    </div>

    <!-- Agents disponibles -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">🤖 Nos agents IA spécialisés</h2>
            <p>Choisissez l'agent qui correspond le mieux à vos besoins d'apprentissage</p>
        </div>

        <?php if (empty($agents)): ?>
            <div class="alert alert-info">
                <strong>Aucun agent disponible pour le moment.</strong><br>
                Les agents IA seront bientôt disponibles pour vous accompagner dans votre apprentissage.
            </div>
        <?php else: ?>
            <div class="grid grid-3">
                <?php foreach ($agents as $agent): ?>
                    <div class="agent-card" data-agent-id="<?= $agent['id_agent'] ?>">
                        <div class="agent-avatar">
                            <?php
                            // Emoji basé sur le nom de l'agent
                            $emoji = '🤖';
                            if (stripos($agent['nom'], 'math') !== false) $emoji = '🔢';
                            elseif (stripos($agent['nom'], 'histoire') !== false) $emoji = '📚';
                            elseif (stripos($agent['nom'], 'scolaire') !== false) $emoji = '🎓';
                            echo $emoji;
                            ?>
                        </div>
                        <h3 class="agent-name"><?= htmlspecialchars($agent['nom']) ?></h3>
                        <p class="agent-description"><?= htmlspecialchars($agent['description']) ?></p>
                        <div style="margin: 1rem 0; padding: 0.75rem; background: var(--gray-50); border-radius: var(--border-radius-sm);">
                            <span style="font-size: 0.875rem; color: var(--gray-600);">
                                👥 Utilisateurs: <strong><?= $agent['nb_utilisateurs'] ?></strong>
                            </span>
                        </div>
                        <div style="margin-top: 1.5rem;">
                            <a href="?page=conversation&action=create&agent=<?= $agent['id_agent'] ?>" class="btn btn-primary">
                                💬 Discuter avec <?= htmlspecialchars($agent['nom']) ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Fonctionnalités -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">✨ Fonctionnalités disponibles</h2>
        </div>

        <div class="grid grid-2">
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: var(--border-radius); border-left: 4px solid var(--primary-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 1rem;">💬 Conversations intelligentes</h3>
                <p>Dialoguez avec nos agents IA spécialisés dans différentes matières pour obtenir une aide personnalisée.</p>
                <a href="/public/?page=conversation" class="btn btn-primary" style="margin-top: 1rem;">Explorer les conversations</a>
            </div>

            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: var(--border-radius); border-left: 4px solid var(--success-color);">
                <h3 style="color: var(--success-color); margin-bottom: 1rem;">📚 Gestion des matières</h3>
                <p>Organisez vos apprentissages par matière et suivez votre progression avec nos outils dédiés.</p>
                <a href="/public/?page=subject" class="btn btn-success" style="margin-top: 1rem;">Voir les matières</a>
            </div>

            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: var(--border-radius); border-left: 4px solid var(--warning-color);">
                <h3 style="color: var(--warning-color); margin-bottom: 1rem;">👥 Gestion des utilisateurs</h3>
                <p>Administrez les comptes utilisateurs et gérez les permissions d'accès aux différents agents.</p>
                <a href="/public/?page=user" class="btn btn-warning" style="margin-top: 1rem;">Gérer les utilisateurs</a>
            </div>

            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: var(--border-radius); border-left: 4px solid var(--danger-color);">
                <h3 style="color: var(--danger-color); margin-bottom: 1rem;">🎯 Niveaux scolaires</h3>
                <p>Configurez les niveaux d'apprentissage pour adapter le contenu aux besoins de chaque utilisateur.</p>
                <a href="/public/?page=level" class="btn btn-danger" style="margin-top: 1rem;">Configurer les niveaux</a>
            </div>
        </div>
    </div>

    <!-- Section d'aide -->
    <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
        <h2 style="text-align: center; margin-bottom: 1.5rem;">� Commencer avec School Agent</h2>
        
        <div class="grid grid-3">
            <div style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">1️⃣</div>
                <h3>Choisissez un agent</h3>
                <p style="opacity: 0.9;">Sélectionnez l'agent IA spécialisé dans la matière qui vous intéresse</p>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">2️⃣</div>
                <h3>Posez vos questions</h3>
                <p style="opacity: 0.9;">Engagez une conversation naturelle avec votre assistant virtuel</p>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">3️⃣</div>
                <h3>Apprenez et progressez</h3>
                <p style="opacity: 0.9;">Recevez des réponses personnalisées et suivez votre progression</p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>