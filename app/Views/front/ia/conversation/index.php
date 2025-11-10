<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations - <?= htmlspecialchars($agent['nom']) ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/conversations.css">
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
            // Faire disparaître le message après 5 secondes
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

    <main class="conversations-page">
        <!-- Hero Simple -->
        <section class="page-hero">
            <div class="container">
                <a href="/ia" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour aux assistants</span>
                </a>
                
                <div class="agent-intro">
                    <div class="agent-avatar-large">
                        <?= strtoupper(substr($agent['nom'], 0, 1)) ?>
                    </div>
                    <div class="agent-info">
                        <h1 class="agent-title"><?= htmlspecialchars($agent['nom']) ?></h1>
                        <p class="agent-desc"><?= htmlspecialchars($agent['description'] ?? 'Assistant IA spécialisé') ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Actions -->
        <section class="page-actions">
            <div class="container">
                <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" class="btn-new-chat">
                    <i class="fas fa-plus-circle"></i>
                    <span>Nouvelle conversation</span>
                </a>
            </div>
        </section>

        <!-- Liste des Conversations -->
        <section class="conversations-section">
            <div class="container">
                <?php if (!empty($conversations)): ?>
                    <div class="conversations-grid">
                        <?php foreach ($conversations as $conv): ?>
                            <article class="conversation-card">
                                <div class="card-top">
                                    <div class="conv-icon">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <button class="delete-btn" onclick="if(confirm('Supprimer cette conversation ?')) { document.getElementById('delete-form-<?= $conv['id_conversation'] ?>').submit(); }">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                
                                <h3 class="conv-title"><?= htmlspecialchars($conv['titre']) ?></h3>
                                <p class="conv-date">
                                    <i class="far fa-calendar"></i>
                                    <?= date('d/m/Y à H:i', strtotime($conv['date_creation'])) ?>
                                </p>
                                
                                <a href="/ia/chat?id=<?= $conv['id_conversation'] ?>" class="view-conv-btn">
                                    Ouvrir la conversation
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                                <form id="delete-form-<?= $conv['id_conversation'] ?>" method="post" action="/ia/delete-conversation" style="display: none;">
                                    <input type="hidden" name="conversation_id" value="<?= $conv['id_conversation'] ?>">
                                    <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                                </form>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-comment-slash"></i>
                        </div>
                        <h3>Aucune conversation</h3>
                        <p>Commencez une nouvelle conversation avec <?= htmlspecialchars($agent['nom']) ?></p>
                        <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" class="btn-start">
                            Démarrer maintenant
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
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
    <script src="/js/front/home.js"></script>
</body>
</html>
