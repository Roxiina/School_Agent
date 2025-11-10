<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistants IA - School Agent</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/ia.css">
</head>
<body>
    <?php include __DIR__ . '/../../templates/ia_header.php'; ?>

    <section class="hero-section">
        <div class="hero-background">
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>
            <div class="gradient-orb orb-3"></div>
            <div class="grid-overlay"></div>
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-icon"></span>
                <span>Intelligence Artificielle</span>
            </div>
            <h1 class="hero-title">
                Découvrez vos <span class="gradient-text">Assistants IA</span>
            </h1>
            <p class="hero-description">
                Des assistants intelligents pour vous accompagner dans votre apprentissage
            </p>
        </div>
    </section>

    <main class="main-content">
        <section class="agents-section">
            <div class="agents-container">
                <?php if (!empty($agents)): ?>
                    <?php foreach ($agents as $agent): ?>
                        <article class="agent-card" data-agent-id="<?= htmlspecialchars($agent['id']) ?>">
                            <div class="card-header">
                                <div class="agent-avatar">
                                    <span class="avatar-letter"><?= strtoupper(substr($agent['name'], 0, 1)) ?></span>
                                    <div class="avatar-ring"></div>
                                </div>
                                <span class="agent-status <?= $agent['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                    <?= $agent['status'] === 'active' ? 'Disponible' : 'Indisponible' ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h3 class="agent-name"><?= htmlspecialchars($agent['name']) ?></h3>
                                <p class="agent-description"><?= htmlspecialchars($agent['description']) ?></p>
                                <div class="agent-tags">
                                    <?php 
                                    $tags = explode(',', $agent['tags'] ?? '');
                                    foreach ($tags as $tag): 
                                        if (trim($tag)): ?>
                                            <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" onclick="selectAgent(<?= $agent['id'] ?>)">
                                    <span>Discuter</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M8 2L14 8L8 14M14 8H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button class="btn btn-secondary" onclick="viewDetails(<?= $agent['id'] ?>)">
                                    En savoir plus
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-container">
                        <div class="empty-icon"></div>
                        <p class="empty-text">Aucun assistant disponible pour le moment</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../../templates/footer.php'; ?>
    
    <script src="/js/front/ia.js"></script>
</body>
</html>
