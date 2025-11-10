<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistants IA - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/ia.css?v=20251110">
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
                <li><a href="/ia" class="nav-link active">Nos Agents</a></li>
                <li><a href="/home#fonctionnalites" class="nav-link">Fonctionnalités</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="ia-container">
        <div class="ia-header">
            <h1> Nos Assistants IA</h1>
            <p>Sélectionnez l''assistant IA avec lequel vous souhaitez converser et bénéficiez d''une aide personnalisée</p>
        </div>

        <?php if (!empty($agents)): ?>
            <div class="agents-grid">
                <?php foreach ($agents as $agent): ?>
                    <div class="agent-card">
                        <div class="agent-avatar">
                            <?php
                                // Generer un emoji aleatoire basé sur le nom de l''agent
                                $emojis = ["", "", "", "", "", "", "", ""];
                                $emoji = $emojis[crc32($agent["id_agent"]) % count($emojis)];
                                echo $emoji;
                            ?>
                        </div>
                        <h3 class="agent-name"><?= htmlspecialchars($agent["nom"]) ?></h3>
                        <p class="agent-description"><?= htmlspecialchars($agent["description"] ?? "Assistant IA spécialisé") ?></p>
                        <a href="/ia/conversations?id=<?= $agent["id_agent"] ?>" class="agent-button">
                            <i class="fas fa-comments"></i> Discuter
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 40px 20px;">
                <p style="font-size: 1.125rem; color: var(--text-secondary);">
                    Aucun assistant ne vous est assigné pour le moment.
                </p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 School Agent. Tous droits réservés. Fait avec  pour l''éducation et l''apprentissage.</p>
        </div>
    </footer>
</body>
</html>
