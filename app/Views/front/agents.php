<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Agents - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/agents.css">
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
                <li><a href="/agents" class="nav-link active">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged): ?>
                    <li><span class="nav-welcome" style="color: #10b981; font-weight: 500; padding: 8px 16px;">
                        Bonjour <?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?> ! 👋
                    </span></li>
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
    <main style="margin-top: 100px; padding: 0 var(--spacing-6);">
        <div style="max-width: 1200px; margin: 0 auto; padding: var(--spacing-12) var(--spacing-6);">
            <!-- Hero Section -->
            <section style="text-align: center; margin-bottom: var(--spacing-20);">
                <h1 style="font-size: var(--font-size-5xl); font-weight: 800; margin-bottom: var(--spacing-4); color: var(--text-primary);">
                    Nos Agents d'IA 🤖
                </h1>
                <p style="font-size: var(--font-size-lg); color: var(--text-secondary); max-width: 600px; margin: 0 auto;">
                    Découvrez nos assistants intelligents spécialisés pour chaque matière. Chaque agent est conçu pour vous accompagner et vous aider dans votre apprentissage.
                </p>
            </section>

            <!-- IA Information Section -->
            <section style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); padding: var(--spacing-12); border-radius: var(--radius-xl); margin-bottom: var(--spacing-20); border-left: 4px solid var(--primary);">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-8); align-items: center;">
                    <!-- Left Column - What AI Does -->
                    <div>
                        <h2 style="font-size: var(--font-size-2xl); font-weight: 700; margin-bottom: var(--spacing-6); color: var(--text-primary); display: flex; align-items: center; gap: var(--spacing-3);">
                            <i class="fas fa-brain" style="color: var(--primary); font-size: var(--font-size-2xl);"></i>
                            Ce que fait l'IA
                        </h2>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-check-circle" style="color: var(--accent); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Explications claires</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Comprend vos questions et fournit des réponses précises adaptées à votre niveau</span>
                                </div>
                            </li>
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-check-circle" style="color: var(--accent); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Support personnalisé</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">S'adapte à votre rythme et réajuste ses explications en fonction de vos besoins</span>
                                </div>
                            </li>
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-check-circle" style="color: var(--accent); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Disponible 24/7</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Apprenez quand vous le souhaitez, sans limites de temps ou d'horaires</span>
                                </div>
                            </li>
                            <li style="display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-check-circle" style="color: var(--accent); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Patience sans fin</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Posez autant de questions que vous le souhaitez, aucun jugement</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Right Column - Why Use It -->
                    <div>
                        <h2 style="font-size: var(--font-size-2xl); font-weight: 700; margin-bottom: var(--spacing-6); color: var(--text-primary); display: flex; align-items: center; gap: var(--spacing-3);">
                            <i class="fas fa-star" style="color: var(--primary); font-size: var(--font-size-2xl);"></i>
                            Pourquoi l'utiliser
                        </h2>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-lightbulb" style="color: var(--primary); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Améliorez vos notes</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Comprenez mieux les concepts difficiles et progressez rapidement</span>
                                </div>
                            </li>
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-rocket" style="color: var(--primary); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Gagnez du temps</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Des réponses instantanées au lieu de chercher dans des livres</span>
                                </div>
                            </li>
                            <li style="margin-bottom: var(--spacing-4); display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-heart" style="color: var(--primary); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Confiance et sérénité</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Un assistant bienveillant toujours prêt à vous aider sans stress</span>
                                </div>
                            </li>
                            <li style="display: flex; gap: var(--spacing-3); align-items: flex-start;">
                                <i class="fas fa-graduation-cap" style="color: var(--primary); margin-top: 2px; flex-shrink: 0;"></i>
                                <div>
                                    <strong>Apprentissage autonome</strong><br>
                                    <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">Devenez plus indépendant dans vos études et acquisitions de connaissances</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Subjects and Agents -->
            <?php if (!empty($agentsBySubject)): ?>
                <?php foreach ($agentsBySubject as $subjectId => $subjectData): ?>
                    <section style="margin-bottom: var(--spacing-20);">
                        <div style="margin-bottom: var(--spacing-8);">
                            <h2 style="font-size: var(--font-size-3xl); font-weight: 700; margin-bottom: var(--spacing-4); color: var(--text-primary); display: flex; align-items: center; gap: var(--spacing-3);">
                                <i class="fas fa-book" style="color: var(--primary);"></i>
                                <?= htmlspecialchars($subjectData['name']) ?>
                            </h2>
                            <p style="font-size: var(--font-size-base); color: var(--text-secondary); margin: 0; padding: var(--spacing-4); background: var(--gray-50); border-radius: var(--radius); border-left: 3px solid var(--primary);">
                                <i class="fas fa-lightbulb" style="color: var(--primary); margin-right: var(--spacing-2);"></i>
                                <?= htmlspecialchars($subjectData['why_use']) ?>
                            </p>
                        </div>
                        
                        <?php if (!empty($subjectData['agents'])): ?>
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--spacing-8);">
                                <?php foreach ($subjectData['agents'] as $agent): ?>
                                    <div style="background: var(--white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow); border: 1px solid var(--gray-200); transition: all 0.3s ease; display: flex; flex-direction: column;" class="feature-card">
                                        <!-- Agent Header -->
                                        <div style="background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%); padding: var(--spacing-8); text-align: center; color: var(--white);">
                                            <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-4); background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: var(--font-size-5xl);">
                                                <?php if (!empty($agent['avatar'])): ?>
                                                    <img src="<?= htmlspecialchars($agent['avatar']) ?>" alt="<?= htmlspecialchars($agent['nom']) ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                                <?php else: ?>
                                                    <i class="fas fa-robot"></i>
                                                <?php endif; ?>
                                            </div>
                                            <h3 style="font-size: var(--font-size-xl); font-weight: 700; margin: 0;">
                                                <?= htmlspecialchars($agent['nom']) ?>
                                            </h3>
                                        </div>
                                        
                                        <!-- Agent Body -->
                                        <div style="padding: var(--spacing-6); flex: 1; display: flex; flex-direction: column;">
                                            <p style="color: var(--text-secondary); font-size: var(--font-size-base); line-height: 1.6; margin-bottom: var(--spacing-6); flex: 1;">
                                                <?= htmlspecialchars($agent['description'] ?? 'Cet agent est prêt à vous aider dans votre apprentissage.') ?>
                                            </p>
                                            
                                            <!-- Agent Footer -->
                                            <div style="display: flex; gap: var(--spacing-3); margin-top: auto;">
                                                <?php if (isset($isLogged) && $isLogged): ?>
                                                    <a href="/conversation?agent=<?= $agent['id_agent'] ?>" style="flex: 1; padding: var(--spacing-3); background: var(--primary); color: var(--white); border: none; border-radius: var(--radius); font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center; font-size: var(--font-size-sm);" class="btn btn-primary" onmouseover="this.style.background='var(--primary-hover)'" onmouseout="this.style.background='var(--primary)'">
                                                        <i class="fas fa-comments"></i> Discuter
                                                    </a>
                                                <?php else: ?>
                                                    <a href="/login" style="flex: 1; padding: var(--spacing-3); background: var(--primary); color: var(--white); border: none; border-radius: var(--radius); font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; text-align: center; font-size: var(--font-size-sm);" class="btn btn-primary" onmouseover="this.style.background='var(--primary-hover)'" onmouseout="this.style.background='var(--primary)'">
                                                        <i class="fas fa-comments"></i> Discuter
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div style="text-align: center; padding: var(--spacing-12); background: var(--gray-50); border-radius: var(--radius-lg); color: var(--text-secondary);">
                                <i class="fas fa-inbox" style="font-size: var(--font-size-3xl); margin-bottom: var(--spacing-4); opacity: 0.5; display: block;"></i>
                                <p style="font-size: var(--font-size-base);">Aucun agent disponible pour cette matière pour le moment.</p>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: var(--spacing-12); background: var(--gray-50); border-radius: var(--radius-lg); color: var(--text-secondary);">
                    <i class="fas fa-inbox" style="font-size: var(--font-size-3xl); margin-bottom: var(--spacing-4); opacity: 0.5; display: block;"></i>
                    <p style="font-size: var(--font-size-base);">Aucun agent disponible pour le moment.</p>
                </div>
            <?php endif; ?>

            <!-- Coming Soon Section -->
            <section style="margin-top: var(--spacing-20); padding: var(--spacing-12); background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%); border-radius: var(--radius-xl); text-align: center; color: var(--white);">
                <h2 style="font-size: var(--font-size-3xl); font-weight: 800; margin-bottom: var(--spacing-4);">
                    🚀 Prochainement d'autres matières
                </h2>
                <p style="font-size: var(--font-size-lg); opacity: 0.95;">
                    Nous travaillons actuellement pour vous proposer des agents spécialisés dans de nouvelles matières. Restez à l'écoute pour les mises à jour !
                </p>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 School Agent. Tous droits réservés. Fait avec ❤️ pour l'éducation et l'apprentissage.</p>
            </div>
        </div>
    </footer>

    <script src="/js/front/home.js"></script>
    <script src="/js/front/agents.js"></script>
</body>
</html>
