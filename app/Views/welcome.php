<?php 
$title = "Accueil - School Agent";
$metaDescription = "School Agent - Votre assistant IA pour l'apprentissage personnalisé. Découvrez nos agents spécialisés pour vous accompagner dans vos études.";

use SchoolAgent\Config\Authenticator;
// On démarre la session pour les messages flash
Authenticator::startSession();
$flash = Authenticator::getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $metaDescription ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 1rem 2.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .btn-primary {
            background: white;
            color: #667eea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        /* Style spécifique pour les boutons du header */
        header .btn-primary {
            background: #667eea;
            color: white;
            border: 2px solid #667eea;
            font-weight: 600;
        }
        
        header .btn-primary:hover {
            background: #5a6fd8;
            border-color: #5a6fd8;
            color: white;
            transform: translateY(-1px);
        }
        
        .btn-outline {
            border: 2px solid rgba(255,255,255,0.8);
            color: white;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }
        
        .features {
            padding: 5rem 2rem;
            background: #f8fafc;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: #64748b;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
        
        /* Footer hover effects */
        footer a:hover {
            color: #667eea !important;
        }
        
        /* Amélioration du contraste général */
        .btn {
            border: none;
            cursor: pointer;
        }
        
        /* Hero buttons avec meilleur contraste */
        .hero .btn-primary {
            background: white;
            color: #2d3748;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        
        .hero .btn-primary:hover {
            background: #f7fafc;
            color: #2d3748;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <!-- Header avec navigation publique -->
    <header style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100;">
        <div class="container">
            <div class="header-content" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0;">
                <a href="?" class="logo" style="font-size: 1.5rem; font-weight: 700; color: #667eea; text-decoration: none;">
                    🎓 School Agent
                </a>
                <nav>
                    <?php if (Authenticator::isLogged()): ?>
                        <a href="?page=dashboard" class="btn btn-primary">
                            <i class="fas fa-tachometer-alt"></i>
                            Tableau de bord
                        </a>
                    <?php else: ?>
                        <a href="?page=login" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i>
                            Connexion
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <!-- Message flash -->
    <?php if ($flash): ?>
        <div style="position: fixed; top: 100px; right: 20px; z-index: 9999; padding: 1rem; border-radius: 8px; font-weight: 500; <?= $flash['type'] === 'error' ? 'background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;' : 'background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- Section Hero -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur School Agent</h1>
            <p>Votre assistant IA pour l'apprentissage personnalisé. Découvrez nos agents spécialisés qui vous accompagnent dans vos études avec intelligence et bienveillance.</p>
            <div class="cta-buttons">
                <?php if (Authenticator::isLogged()): ?>
                    <a href="?page=dashboard" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i>
                        Accéder au tableau de bord
                    </a>
                <?php else: ?>
                    <a href="?page=login" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </a>
                    <a href="?page=register" class="btn btn-outline">
                        <i class="fas fa-user-plus"></i>
                        Créer un compte
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Section Features -->
    <section class="features">
        <div class="container">
            <div style="text-align: center; margin-bottom: 4rem;">
                <h2 style="font-size: 2.5rem; color: #2c3e50; margin-bottom: 1rem;">Pourquoi choisir School Agent ?</h2>
                <p style="font-size: 1.2rem; color: #64748b; max-width: 600px; margin: 0 auto;">Nos agents IA spécialisés vous offrent un accompagnement personnalisé pour réussir vos études.</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3>IA Spécialisée</h3>
                    <p>Chaque agent est expert dans sa matière : mathématiques, histoire, sciences... Un accompagnement adapté à chaque discipline.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Suivi Personnalisé</h3>
                    <p>Progression adaptée à votre niveau et à votre rythme. L'IA s'adapte à vos forces et vous aide à surmonter vos difficultés.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>100% Sécurisé</h3>
                    <p>Vos données sont protégées et votre vie privée respectée. Conformité RGPD et sécurité maximale garanties.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>24h/24</h3>
                    <p>Votre assistant personnel est toujours disponible. Posez vos questions à tout moment, obtenez des réponses instantanées.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Conversations Naturelles</h3>
                    <p>Échangez naturellement avec nos agents. Ils comprennent vos questions et s'adaptent à votre style d'apprentissage.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Tous Niveaux</h3>
                    <p>Du collège à l'université, nos agents s'adaptent à votre niveau scolaire pour un accompagnement optimal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: var(--gray-800, #1f2937); color: white; padding: 3rem 0 1.5rem;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <h3 style="color: white; margin-bottom: 1rem; font-size: 1.25rem;">🎓 School Agent</h3>
                    <p style="color: #9ca3af; margin-bottom: 1rem; line-height: 1.6;">
                        Assistant IA pour l'apprentissage et l'accompagnement scolaire personnalisé.
                    </p>
                    <p style="color: #9ca3af; font-size: 0.875rem;">
                        Développé avec ❤️ par Olivier / Nicolas / Flavie
                    </p>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 1rem; font-size: 1.25rem;">📚 Services</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="?page=conversation" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Conversations IA</a>
                        <a href="?page=subject" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Matières</a>
                        <a href="?page=level" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Niveaux scolaires</a>
                        <a href="?page=user" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Gestion utilisateurs</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 1rem; font-size: 1.25rem;">🔒 Confidentialité & Légal</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="?page=privacy-policy" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Politique de confidentialité</a>
                        <a href="?page=terms" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Conditions d'utilisation</a>
                        <a href="?page=cookie-policy" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Gestion des cookies</a>
                        <a href="?page=data-request" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Mes données (RGPD)</a>
                    </div>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 1rem; font-size: 1.25rem;">📞 Contact</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="mailto:contact@schoolagent.fr" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Support technique</a>
                        <a href="mailto:dpo@schoolagent.fr" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">Délégué à la protection des données</a>
                        <a href="https://www.cnil.fr" target="_blank" style="color: #9ca3af; text-decoration: none; transition: color 0.3s;">CNIL - Vos droits</a>
                    </div>
                </div>
            </div>
            
            <div style="border-top: 1px solid #374151; padding-top: 2rem; text-align: center;">
                <p style="color: #9ca3af; margin-bottom: 0.5rem;">&copy; <?= date('Y') ?> School Agent. Tous droits réservés.</p>
                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">
                    Conforme au RGPD • Hébergé en France • 
                    <button onclick="window.schoolAgent?.showCookiePreferences?.()" 
                            style="background: none; border: none; color: #6b7280; text-decoration: underline; cursor: pointer;">
                        Gérer les cookies
                    </button>
                </p>
            </div>
        </div>
    </footer>

</body>
</html>