<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations - <?= htmlspecialchars($agent['nom']) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/conversations.css?v=20251110">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="/" class="logo">
                    <i class="fas fa-brain"></i>
                    <span>School Agent</span>
                </a>
                <nav class="nav-container">
                    <div class="nav-menu">
                        <a href="/" class="nav-link">Accueil</a>
                        <a href="/ia" class="nav-link active">Nos Assistants</a>
                        <a href="/" class="nav-link">Fonctionnalités</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="conversations-main">
        <!-- Hero Section -->
        <div class="conversations-hero">
            <div class="container">
                <a href="/ia" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour aux assistants</span>
                </a>
                <div class="hero-content">
                    <div class="agent-badge">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h1><?= htmlspecialchars($agent['nom']) ?></h1>
                    <p><?= htmlspecialchars($agent['description'] ?? 'Assistant IA spécialisé pour vous accompagner') ?></p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="container conversations-content">
            <!-- Actions Bar -->
            <div class="actions-bar">
                <h2>Mes conversations</h2>
                <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" class="btn-new-conversation">
                    <i class="fas fa-plus"></i>
                    <span>Nouvelle conversation</span>
                </a>
            </div>

            <!-- Conversations List -->
            <?php if (!empty($conversations)): ?>
                <div class="conversations-grid">
                    <?php foreach ($conversations as $index => $conversation): ?>
                        <div class="conversation-card" style="animation: slideUp 0.4s ease-out forwards; animation-delay: <?= ($index * 0.05) ?>s;">
                            <div class="card-header">
                                <div class="conversation-info">
                                    <i class="fas fa-comments"></i>
                                    <div class="conversation-meta">
                                        <h3>
                                            <?php
                                                $date = new DateTime($conversation['date_creation']);
                                                echo 'Conversation du ' . $date->format('d/m/Y');
                                            ?>
                                        </h3>
                                        <span class="conversation-time">
                                            <i class="fas fa-clock"></i>
                                            <?php echo $date->format('H:i'); ?>
                                        </span>
                                    </div>
                                </div>
                                <form method="post" action="/ia/conversation/delete" class="delete-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?');">
                                    <input type="hidden" name="conversation_id" value="<?= $conversation['id_conversation'] ?>">
                                    <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                                    <button type="submit" class="btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <div class="card-body">
                                <div class="conversation-preview">
                                    <?php
                                        $messages = $conversation['messages'] ?? [];
                                        $lastMessage = !empty($messages) ? end($messages) : null;
                                        if ($lastMessage && !empty($lastMessage['question'])):
                                            $preview = substr(htmlspecialchars($lastMessage['question']), 0, 120);
                                            if (strlen($lastMessage['question']) > 120) $preview .= '...';
                                    ?>
                                        <p><i class="fas fa-quote-left"></i> <?= $preview ?></p>
                                    <?php else: ?>
                                        <p class="no-messages"><i class="fas fa-inbox"></i> Aucun message</p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-stats">
                                    <span class="stat">
                                        <i class="fas fa-message"></i>
                                        <?= count($messages) ?> message<?= count($messages) > 1 ? 's' : '' ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <a href="/ia/chat?id=<?= $conversation['id_conversation'] ?>" class="btn-view">
                                    <span>Voir la conversation</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Aucune conversation</h3>
                    <p>Vous n'avez pas encore de conversation avec <?= htmlspecialchars($agent['nom']) ?>.</p>
                    <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Commencer une conversation</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>School Agent</h4>
                    <p>Plateforme d'apprentissage avec assistance IA</p>
                </div>
                <div class="footer-section">
                    <h4>Navigation</h4>
                    <a href="/">Accueil</a>
                    <a href="/ia">Assistants</a>
                </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>support@schoolagent.local</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 School Agent. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="/js/front/conversations.js?v=20251110"></script>
</body>
</html>
