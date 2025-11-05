<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Agents - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/css/front/dashboard.css">

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-6);
            margin-bottom: var(--spacing-16);
        }

        .stat-item {
            background: white;
            border-radius: var(--radius-lg);
            padding: var(--spacing-8);
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
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

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-item-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: var(--spacing-4);
        }

        .agent-name {
            font-size: var(--font-size-lg);
            font-weight: 700;
            color: var(--text-primary);
        }

        .agent-icon {
            font-size: 24px;
            color: var(--primary);
        }

        .stat-content {
            display: grid;
            gap: var(--spacing-3);
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-3) 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .stat-row:last-child {
            border-bottom: none;
        }

        .stat-label {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            font-weight: 500;
        }

        .stat-value {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--primary);
        }

        .stat-footer {
            margin-top: var(--spacing-4);
            padding-top: var(--spacing-4);
            border-top: 2px solid var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .last-activity {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            background: var(--primary);
            color: white;
            padding: var(--spacing-2) var(--spacing-4);
            border-radius: var(--radius-md);
            text-decoration: none;
            font-size: var(--font-size-sm);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background: var(--primary-dark);
            transform: translateX(2px);
        }

        .empty-state-container {
            background: white;
            border-radius: var(--radius-lg);
            padding: var(--spacing-16);
            text-align: center;
            box-shadow: var(--shadow-lg);
            margin-top: var(--spacing-8);
        }

        .empty-state-icon {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: var(--spacing-4);
        }

        .empty-state-text {
            color: var(--text-secondary);
            margin-bottom: var(--spacing-6);
            font-size: var(--font-size-base);
        }

        .empty-state-link {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            background: var(--primary);
            color: white;
            padding: var(--spacing-3) var(--spacing-6);
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .empty-state-link:hover {
            background: var(--primary-dark);
            transform: translateX(2px);
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
                        <a href="/dashboard/agents" class="burger-item active">
                            <i class="fas fa-brain"></i> Suivi des Agents
                        </a>
                        <a href="/dashboard/conversations" class="burger-item">
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
            <i class="fas fa-chart-line"></i> Suivi de Vos Agents
        </h1>

        <?php if (empty($agents)): ?>
            <div class="empty-state-container">
                <div class="empty-state-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <p class="empty-state-text">Vous n'avez pas encore d'interactions avec les agents</p>
                <a href="/agents" class="empty-state-link">
                    <i class="fas fa-arrow-right"></i> Découvrir les agents
                </a>
            </div>
        <?php else: ?>
            <div class="stats-grid">
                <?php foreach ($agents as $agent): ?>
                    <div class="stat-item">
                        <div class="stat-item-header">
                            <span class="agent-name"><?= htmlspecialchars($agent['nom']) ?></span>
                            <i class="fas fa-robot agent-icon"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-row">
                                <span class="stat-label">Conversations</span>
                                <span class="stat-value"><?= $agent['conversationCount'] ?></span>
                            </div>
                            <div class="stat-row">
                                <span class="stat-label">Messages</span>
                                <span class="stat-value"><?= $agent['messageCount'] ?></span>
                            </div>
                        </div>
                        <div class="stat-footer">
                            <span class="last-activity">
                                <i class="fas fa-clock"></i>
                                <?= htmlspecialchars($agent['lastActivity']) ?>
                            </span>
                            <a href="/dashboard/conversations" class="view-btn">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="/js/front/dashboard.js"></script>
</body>
</html>
