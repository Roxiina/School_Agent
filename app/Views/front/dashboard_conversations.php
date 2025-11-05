<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Conversations - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/css/front/dashboard.css">

    <style>
        .agent-section {
            margin-bottom: var(--spacing-16);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .agent-section-title {
            background: white;
            padding: var(--spacing-6);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            border-bottom: 3px solid var(--primary);
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            box-shadow: var(--shadow-lg);
        }

        .agent-section-title i {
            color: var(--primary);
        }

        .conversation-list {
            background: white;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            margin-bottom: var(--spacing-4);
        }

        .conversation-item {
            padding: var(--spacing-6);
            border-bottom: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .conversation-item:last-child {
            border-bottom: none;
        }

        .conversation-item:hover {
            background-color: var(--gray-50);
            padding-left: var(--spacing-12);
        }

        .conversation-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: var(--spacing-2);
        }

        .conversation-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--font-size-base);
            word-break: break-word;
        }

        .conversation-meta {
            display: flex;
            gap: var(--spacing-4);
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            margin-top: var(--spacing-2);
        }

        .conversation-meta i {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            <div class="nav-right">
                <a href="/home">← Retour à l'accueil</a>
                <div class="burger-menu">
                    <button class="burger-btn" id="burgerBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="burger-dropdown" id="burgerDropdown">
                        <a href="/profile" class="burger-item">
                            <i class="fas fa-user-circle"></i> Mon Profil
                        </a>
                        <a href="/dashboard/agents" class="burger-item">
                            <i class="fas fa-brain"></i> Suivi des Agents
                        </a>
                        <a href="/dashboard/conversations" class="burger-item active">
                            <i class="fas fa-comments"></i> Historique des Conversations
                        </a>
                        <hr style="margin: 10px 0; border: none; border-top: 1px solid var(--gray-200);">
                        <a href="/logout" class="burger-item logout">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Container -->
    <div class="container">
        <a href="/profile" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour au profil
        </a>

        <h1 class="page-title">
            <i class="fas fa-comments"></i> Historique de Vos Conversations
        </h1>

        <?php if (empty($conversationsByAgent)): ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Vous n'avez encore aucune conversation</p>
                <a href="/agents" style="color: var(--primary); text-decoration: none; font-weight: 600;">
                    <i class="fas fa-arrow-right"></i> Commencer une conversation
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($conversationsByAgent as $agentName => $data): ?>
                <div class="agent-section" id="<?= htmlspecialchars($agentName) ?>">
                    <div class="agent-section-title">
                        <i class="fas fa-brain"></i>
                        <?= htmlspecialchars($data['agent']['nom']) ?>
                        <span style="margin-left: auto; font-size: var(--font-size-sm); color: var(--text-secondary);">
                            <?= count($data['conversations']) ?> conversation<?= count($data['conversations']) > 1 ? 's' : '' ?>
                        </span>
                    </div>
                    <div class="conversation-list">
                        <?php foreach ($data['conversations'] as $conv): ?>
                            <div class="conversation-item">
                                <div class="conversation-header">
                                    <div class="conversation-title">
                                        <?= htmlspecialchars($conv['conversation']['titre'] ?? 'Conversation sans titre') ?>
                                    </div>
                                </div>
                                <div class="conversation-meta">
                                    <span>
                                        <i class="fas fa-comments"></i>
                                        <?= $conv['messageCount'] ?> message<?= $conv['messageCount'] > 1 ? 's' : '' ?>
                                    </span>
                                    <span>
                                        <i class="fas fa-calendar"></i>
                                        <?= date('d/m/Y', strtotime($conv['conversation']['date_creation'])) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="/js/front/dashboard.js"></script>
</body>
</html>
