<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat avec <?= htmlspecialchars($agent['nom']) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUkrQ6usKNU8gMadcHKYc13/iU1A7P29DEkJUxm1qgkDBEhdP1mNvWDmkwcPmDljVRQw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/chat.css?v=20251110">
    <style>
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-layout {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 0;
            margin-top: 70px;
        }

        .chat-area {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: var(--spacing-4);
            background-color: white;
        }

        .chat-input-container {
            padding: var(--spacing-4);
            border-top: 1px solid var(--gray-200);
            background-color: white;
        }

        .chat-sidebar {
            background-color: var(--gray-50);
            border-left: 1px solid var(--gray-200);
            overflow-y: auto;
        }

        @media (max-width: 1024px) {
            .chat-layout {
                grid-template-columns: 1fr;
            }

            .chat-sidebar {
                border-left: none;
                border-top: 1px solid var(--gray-200);
                grid-column: 1;
            }
        }

        footer {
            margin-top: auto;
        }

        /* Message Styles */
        .message-group {
            display: flex;
            align-items: flex-end;
            margin-bottom: var(--spacing-3);
            width: 100%;
        }

        .message-group.user-message {
            justify-content: flex-end;
        }

        .message-group.ai-message {
            justify-content: flex-start;
            gap: var(--spacing-2);
        }

        .message {
            display: flex;
            align-items: flex-end;
            gap: var(--spacing-2);
            max-width: 70%;
        }

        .message.user-message {
            justify-content: flex-end;
            flex-direction: row-reverse;
        }

        .message-content {
            padding: var(--spacing-3) var(--spacing-4);
            border-radius: var(--radius-lg);
            word-wrap: break-word;
            word-break: break-word;
            line-height: 1.5;
            display: inline-block;
        }

        .message-content p {
            margin: 0;
            padding: 0;
            white-space: pre-wrap;
        }

        .user-message .message-content {
            background: var(--primary);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .ai-message {
            display: flex;
            align-items: flex-end;
            gap: var(--spacing-2);
            max-width: 70%;
        }

        .ai-message .message-content {
            background: var(--gray-100);
            color: var(--gray-900);
            border-bottom-left-radius: 4px;
        }

        .message-author {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: var(--spacing-1);
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--gray-500);
            text-align: center;
            gap: var(--spacing-4);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray-300);
        }

        .empty-state h3 {
            margin: 0;
            color: var(--gray-700);
            font-size: 1.25rem;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.9rem;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-4);
            padding: var(--spacing-4);
            border-bottom: 1px solid var(--gray-200);
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary-hover);
            transform: translateX(-4px);
        }

        .chat-header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--gray-900);
            flex: 1;
        }

        .agent-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: var(--spacing-4);
        }

        .delete-btn {
            color: #ef4444 !important;
        }

        .delete-btn:hover {
            background-color: #fef2f2 !important;
            color: #ef4444 !important;
        }

        .sidebar-info {
            background-color: var(--gray-50);
            padding: var(--spacing-3);
            border-radius: var(--radius-lg);
            font-size: 0.85rem;
        }

        .sidebar-info p {
            margin: var(--spacing-2) 0;
            color: var(--gray-600);
        }

        .sidebar-info strong {
            color: var(--gray-900);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="/" class="logo">
                    <i class="fas fa-brain"></i>
                    <span>SchoolIA</span>
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
    <main>
        <!-- Chat Interface -->
        <div class="chat-layout">
            <!-- Main Chat Area -->
            <div class="chat-area">
                <!-- Chat Header -->
                <div class="chat-header">
                    <a href="/ia/conversations?id=<?= $agent['id_agent'] ?>" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour à l'historique</span>
                    </a>
                    <h1><?= htmlspecialchars($conversation['titre']) ?></h1>
                </div>

                <!-- Messages Container -->
                <div class="chat-messages">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $index => $message): ?>
                            <!-- User Message -->
                            <div class="message-group" style="animation: fadeIn 0.3s ease-in forwards; animation-delay: <?= ($index * 0.05) ?>s;">
                                <div class="message user-message">
                                    <div class="message-content">
                                        <p><?= nl2br(htmlspecialchars($message['question'])) ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- AI Message -->
                            <?php if (!empty($message['reponse'])): ?>
                                <div class="message-group" style="animation: fadeIn 0.3s ease-in forwards; animation-delay: <?= ($index * 0.05 + 0.1) ?>s;">
                                    <div class="message ai-message">
                                        <div class="message-avatar">
                                            <i class="fas fa-robot"></i>
                                        </div>
                                        <div class="message-content">
                                            <p class="message-author"><?= htmlspecialchars($agent['nom']) ?></p>
                                            <p><?= nl2br(htmlspecialchars($message['reponse'])) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-message"></i>
                            <h3>Commencez la conversation</h3>
                            <p>C'est le début de votre discussion. Posez votre première question à <?= htmlspecialchars($agent['nom']) ?> !</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Chat Input -->
                <div class="chat-input-container">
                    <form method="post" action="" class="chat-input-form">
                        <?php if ($isNew ?? false): ?>
                            <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                        <?php endif; ?>
                        <textarea name="prompt" class="chat-textarea" placeholder="Posez votre question..." required></textarea>
                        <button type="submit" class="chat-submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            <span>Envoyer</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="chat-sidebar">
                <div class="agent-info">
                    <div class="agent-avatar">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3><?= htmlspecialchars($agent['nom']) ?></h3>
                    <p class="agent-description"><?= htmlspecialchars($agent['description'] ?? 'Assistant IA spécialisé') ?></p>
                </div>

                <div class="sidebar-actions">
                    <a href="/ia" class="sidebar-btn">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                    <a href="/ia/conversations?id=<?= $agent['id_agent'] ?>" class="sidebar-btn">
                        <i class="fas fa-history"></i>
                        <span>Historique</span>
                    </a>
                    <button type="button" class="sidebar-btn delete-btn" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?')) { /* action */ }">
                        <i class="fas fa-trash"></i>
                        <span>Supprimer</span>
                    </button>
                </div>

                <div class="sidebar-info">
                    <p><strong>ID Conversation:</strong> <?= htmlspecialchars($conversation['id_conversation'] ?? 'N/A') ?></p>
                    <p><strong>Messages:</strong> <?= count($messages ?? []) * 2 ?></p>
                </div>
            </aside>
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

    <script src="/js/front/chat.js?v=20251110"></script>
</body>
</html>
