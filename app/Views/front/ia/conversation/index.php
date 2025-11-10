<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations avec <?= htmlspecialchars($agent['nom']) ?></title>
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
                        <a href="/ia" class="nav-link">Nos Assistants</a>
                        <a href="/" class="nav-link">Fonctionnalités</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="conversations-container">
        <!-- Breadcrumb & Header -->
        <div class="conversations-header">
            <a href="/ia" class="breadcrumb-link">
                <i class="fas fa-arrow-left"></i>
                <span>Retour aux assistants</span>
            </a>
            <div class="header-info">
                <div class="agent-badge">
                    <i class="fas fa-robot"></i>
                </div>
                <div>
                    <h1>Conversations avec <?= htmlspecialchars($agent['nom']) ?></h1>
                    <p class="agent-meta"><?= htmlspecialchars($agent['description'] ?? 'Assistant IA spécialisé') ?></p>
                </div>
            </div>
        </div>

        <!-- New Conversation Button -->
        <div class="new-conversation-section">
            <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" class="btn-primary">
                <i class="fas fa-plus"></i>
                <span>Nouvelle conversation</span>
            </a>
        </div>

        <!-- Conversations List -->
        <div class="conversations-section">
            <h2>Historique</h2>
            
            <?php if (!empty($conversations)): ?>
                <div class="conversations-list">
                    <?php foreach ($conversations as $index => $conversation): ?>
                        <div class="conversation-card" style="animation: fadeIn 0.3s ease-in forwards; animation-delay: <?= ($index * 0.05) ?>s;">
                            <div class="conversation-header">
                                <div class="conversation-title">
                                    <i class="fas fa-message-circle"></i>
                                    <a href="/ia/chat?id=<?= $conversation['id_conversation'] ?>">
                                        <?php
                                            $date = new DateTime($conversation['date_creation']);
                                            echo 'Conversation du ' . $date->format('d/m/Y');
                                        ?>
                                    </a>
                                    <span class="conversation-time">
                                        <?php echo $date->format('H:i'); ?>
                                    </span>
                                </div>
                                <div class="conversation-actions">
                                    <form method="post" action="/ia/conversation/delete" class="delete-form">
                                        <input type="hidden" name="conversation_id" value="<?= $conversation['id_conversation'] ?>">
                                        <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                                        <button type="submit" class="btn-delete" data-id="<?= $conversation['id_conversation'] ?>">
                                            <i class="fas fa-trash"></i>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="conversation-preview">
                                <?php
                                    // Afficher un aperçu du dernier message
                                    $messages = $conversation['messages'] ?? [];
                                    $lastMessage = !empty($messages) ? end($messages) : null;
                                    if ($lastMessage):
                                        $preview = substr(htmlspecialchars($lastMessage['question']), 0, 80);
                                        if (strlen($lastMessage['question']) > 80) $preview .= '...';
                                        echo '<p>' . $preview . '</p>';
                                    else:
                                        echo '<p style="color: var(--gray-400);">Aucun message</p>';
                                    endif;
                                ?>
                            </div>
                            <div class="conversation-footer">
                                <a href="/ia/chat?id=<?= $conversation['id_conversation'] ?>" class="btn-secondary">
                                    Voir la conversation
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
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
                    <h4>SchoolIA</h4>
                    <p>Plateforme d'apprentissage avec assistance IA</p>
                </div>
                <div class="footer-section">
                    <h4>Navigation</h4>
                    <a href="/">Accueil</a>
                    <a href="/ia">Assistants</a>
                </div>
                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>support@schoolia.local</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 SchoolIA. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="/js/front/conversations.js?v=20251110"></script>
</body>
</html>
