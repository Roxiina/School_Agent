<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/conversation.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <ul class="nav-menu">
                <li><a href="/home" class="nav-link">Accueil</a></li>
                <li><a href="/agents" class="nav-link">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged && isset($user['role']) && $user['role'] === 'etudiant'): ?>
                    <li><a href="/conversation" class="nav-link active" style="color: #10b981; font-weight: 600;">💬 Discuter</a></li>
                <?php endif; ?>
                <?php if (isset($isLogged) && $isLogged): ?>
                    <li><span class="nav-welcome" style="color: #10b981; font-weight: 500; padding: 8px 16px;">
                        Bonjour <?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?> ! 👋
                    </span></li>
                    <li><a href="/logout" class="btn btn-danger" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Main Conversation Container -->
    <div class="conversation-container">
        <!-- Sidebar with Agents -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">Sélectionner un agent</h3>
            </div>
            <div class="agents-list">
                <?php if (!empty($agents) ?? false): ?>
                    <?php foreach ($agents as $agent): ?>
                        <a href="/conversation?agent=<?= $agent['id_agent'] ?>" 
                           class="agent-item <?= isset($_GET['agent']) && $_GET['agent'] == $agent['id_agent'] ? 'active' : '' ?>">
                            <div class="agent-avatar">
                                <?= substr($agent['nom'], 0, 1) ?>
                            </div>
                            <span class="agent-name"><?= htmlspecialchars($agent['nom']) ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="padding: 12px; color: var(--text-secondary); font-size: 13px; text-align: center;">
                        Aucun agent disponible
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Chat Area -->
        <main class="chat-area">
            <?php if (isset($agent) && $agent): ?>
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="agent-avatar" style="width: 44px; height: 44px; font-size: 20px;">
                        <?= substr($agent['nom'], 0, 1) ?>
                    </div>
                    <div class="chat-header-info">
                        <div class="chat-header-title"><?= htmlspecialchars($agent['nom']) ?></div>
                        <div class="chat-header-subtitle">Expert en <?= htmlspecialchars($agent['nom']) ?></div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="messages-container" id="messagesContainer">
                    <div class="message agent">
                        <div class="message-avatar agent">
                            <?= substr($agent['nom'], 0, 1) ?>
                        </div>
                        <div>
                            <div class="message-bubble">
                                Bonjour <?= htmlspecialchars($user['prenom'] ?? 'étudiant') ?> ! 👋 Je suis <?= htmlspecialchars($agent['nom']) ?>, ton assistant IA spécialisé. Comment puis-je t'aider aujourd'hui ?
                            </div>
                            <div class="message-time">À l'instant</div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-area">
                    <div class="input-wrapper">
                        <textarea class="chat-input" id="messageInput" placeholder="Pose ta question..." rows="1"></textarea>
                    </div>
                    <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>

            <?php else: ?>
                <!-- No Agent Selected -->
                <div class="messages-container">
                    <div class="no-messages select-agent-message">
                        <div class="select-agent-icon">🤖</div>
                        <div class="select-agent-title">Sélectionne un agent</div>
                        <p class="select-agent-text">Choisis un agent dans la liste de gauche pour commencer une conversation</p>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Scripts -->
    <script src="/js/front/conversation.js"></script>
</body>
</html>
