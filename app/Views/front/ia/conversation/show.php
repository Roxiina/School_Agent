<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat avec <?= htmlspecialchars($agent['nom']) ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/chat.css?v=20251110">
</head>
<body>
    <!-- Flash Messages -->
    <?php
    use SchoolAgent\Config\Authenticator;
    $flash = Authenticator::getFlash();
    if ($flash): ?>
        <div class="flash-message flash-<?= $flash['type'] ?>" style="position: fixed; top: 20px; right: 20px; z-index: 1000; padding: 15px 20px; border-radius: 5px; color: white; font-weight: 500;">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
        <script>
            setTimeout(() => {
                const flashMsg = document.querySelector('.flash-message');
                if (flashMsg) flashMsg.style.display = 'none';
            }, 5000);
        </script>
    <?php endif; ?>

    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <ul class="nav-menu">
                <li><a href="/home" class="nav-link">Accueil</a></li>
                <li><a href="/ia" class="nav-link active">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged && isset($user['role']) && $user['role'] === 'etudiant'): ?>
                    <li><a href="/ia" class="nav-link" style="color: #10b981; font-weight: 600;">💬 Discuter</a></li>
                <?php endif; ?>
                <?php if (isset($isLogged) && $isLogged): ?>
                    <li><span class="nav-welcome" style="color: #10b981; font-weight: 500; padding: 8px 16px;">
                        Bonjour <?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?> ! 👋
                    </span></li>
                    <li><a href="/profile" class="btn btn-secondary" style="background: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">👤 Mon Profil</a></li>
                    <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                        <li><a href="/admin" class="btn btn-secondary" style="background: #6366f1; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Administration</a></li>
                    <?php endif; ?>
                    <li><a href="/logout" class="btn btn-danger" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="/login" class="btn btn-primary">Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="chat-page">
        <div class="chat-container">
            <!-- Chat Header -->
            <div class="chat-header">
                <a href="/ia/conversations?id=<?= $agent['id_agent'] ?>" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour</span>
                </a>
                <div class="chat-title">
                    <h1><?= htmlspecialchars($conversation['titre']) ?></h1>
                    <p class="agent-name">
                        <i class="fas fa-robot"></i>
                        <?= htmlspecialchars($agent['nom']) ?>
                    </p>
                </div>
            </div>

            <!-- Messages -->
            <div class="messages-container">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <!-- User Message -->
                        <div class="message-wrapper user">
                            <div class="message-content">
                                <?= nl2br(htmlspecialchars($message['question'])) ?>
                            </div>
                        </div>

                        <!-- AI Response -->
                        <?php if (!empty($message['reponse'])): ?>
                            <div class="message-wrapper assistant">
                                <div class="message-avatar">
                                    <?= strtoupper(substr($agent['nom'], 0, 1)) ?>
                                </div>
                                <div class="message-content">
                                    <div class="message-author"><?= htmlspecialchars($agent['nom']) ?></div>
                                    <?= nl2br(htmlspecialchars($message['reponse'])) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-chat">
                        <div class="empty-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Commencez la conversation</h3>
                        <p>Posez votre première question à <?= htmlspecialchars($agent['nom']) ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chat Input -->
            <div class="chat-input-area">
                <form method="post" class="chat-form">
                    <?php if ($isNew ?? false): ?>
                        <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                    <?php endif; ?>
                    <textarea 
                        name="prompt" 
                        class="chat-input" 
                        placeholder="Posez votre question..."
                        rows="1"
                        required
                    ></textarea>
                    <button type="submit" class="send-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 School Agent. Tous droits réservés. Olivier / Nicolas / Flavie</p>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="/js/front/chat.js?v=20251110"></script>
    <script src="/js/front/home.js"></script>
</body>
</html>
