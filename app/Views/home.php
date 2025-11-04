<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Agent - Assistant IA pour l'apprentissage</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Colors */
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #f8fafc;
            --accent: #10b981;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            
            /* Spacing */
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 0.75rem;
            --spacing-4: 1rem;
            --spacing-6: 1.5rem;
            --spacing-8: 2rem;
            --spacing-12: 3rem;
            --spacing-16: 4rem;
            --spacing-20: 5rem;
            
            /* Typography */
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;
            
            /* Radius */
            --radius: 0.5rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --radius-full: 9999px;
            
            /* Shadow */
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--white);
        }
        
        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-200);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        
        .logo {
            font-size: var(--font-size-xl);
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
        }
        
        .logo i {
            font-size: var(--font-size-2xl);
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: var(--spacing-8);
            align-items: center;
        }
        
        .nav-link {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .nav-link.active {
            color: var(--primary);
        }
        
        .btn {
            padding: var(--spacing-3) var(--spacing-6);
            border-radius: var(--radius-lg);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        /* Hero Section */
        .hero {
            padding-top: 120px;
            padding-bottom: var(--spacing-20);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: var(--font-size-5xl);
            font-weight: 800;
            margin-bottom: var(--spacing-6);
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: var(--font-size-xl);
            margin-bottom: var(--spacing-8);
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            gap: var(--spacing-4);
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-large {
            padding: var(--spacing-4) var(--spacing-8);
            font-size: var(--font-size-lg);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
        }
        
        /* Features Section */
        .features {
            padding: var(--spacing-20) 0;
            background: var(--gray-50);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
        }
        
        .section-title {
            text-align: center;
            font-size: var(--font-size-4xl);
            font-weight: 800;
            margin-bottom: var(--spacing-4);
            color: var(--text-primary);
        }
        
        .section-subtitle {
            text-align: center;
            font-size: var(--font-size-lg);
            color: var(--text-secondary);
            margin-bottom: var(--spacing-16);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-8);
        }
        
        .feature-card {
            background: var(--white);
            padding: var(--spacing-8);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--gray-200);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--spacing-6);
            font-size: var(--font-size-2xl);
            color: var(--white);
        }
        
        .feature-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--spacing-3);
            color: var(--text-primary);
        }
        
        .feature-description {
            color: var(--text-secondary);
            line-height: 1.6;
        }
        
        /* Stats Section */
        .stats {
            padding: var(--spacing-16) 0;
            background: var(--primary);
            color: var(--white);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-8);
            text-align: center;
        }
        
        .stat-number {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            margin-bottom: var(--spacing-2);
        }
        
        .stat-label {
            font-size: var(--font-size-lg);
            opacity: 0.9;
        }
        
        /* CTA Section */
        .cta {
            padding: var(--spacing-20) 0;
            background: var(--white);
            text-align: center;
        }
        
        .cta-title {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            margin-bottom: var(--spacing-4);
            color: var(--text-primary);
        }
        
        .cta-subtitle {
            font-size: var(--font-size-lg);
            color: var(--text-secondary);
            margin-bottom: var(--spacing-8);
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Footer */
        .footer {
            background: var(--text-primary);
            color: var(--white);
            padding: var(--spacing-12) 0 var(--spacing-6);
        }
        
        .footer-content {
            text-align: center;
            opacity: 0.8;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: var(--font-size-3xl);
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-menu {
                display: none;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                <li><a href="#accueil" class="nav-link active">Accueil</a></li>
                <li><a href="#fonctionnalites" class="nav-link">Fonctionnalités</a></li>
                <li><a href="#a-propos" class="nav-link">À propos</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="/login" class="btn btn-primary">Se connecter</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <div class="hero-container">
            <h1 class="hero-title animate-fade-in">
                Bienvenue sur School Agent ! 🎓
            </h1>
            <p class="hero-subtitle animate-fade-in">
                Votre assistant IA personnel pour l'apprentissage. Transformez votre façon d'étudier avec une intelligence artificielle adaptée à votre niveau et vos besoins.
            </p>
            <div class="hero-buttons animate-fade-in">
                <a href="/login" class="btn btn-primary btn-large">
                    <i class="fas fa-rocket"></i>
                    Commencer maintenant
                </a>
                <a href="#fonctionnalites" class="btn btn-outline btn-large">
                    <i class="fas fa-info-circle"></i>
                    Découvrir les fonctionnalités
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fonctionnalites">
        <div class="container">
            <h2 class="section-title">Pourquoi choisir School Agent ?</h2>
            <p class="section-subtitle">
                Découvrez comment notre IA révolutionne votre expérience d'apprentissage
            </p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="feature-title">IA Adaptative</h3>
                    <p class="feature-description">
                        Notre intelligence artificielle s'adapte à votre niveau et à votre rythme d'apprentissage pour des explications personnalisées.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="feature-title">Toutes les matières</h3>
                    <p class="feature-description">
                        Mathématiques, français, histoire, sciences... School Agent couvre l'ensemble du programme scolaire de tous les niveaux.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="feature-title">Dialogue interactif</h3>
                    <p class="feature-description">
                        Posez vos questions en langage naturel et obtenez des réponses claires, détaillées et adaptées à votre niveau.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Suivi des progrès</h3>
                    <p class="feature-description">
                        Visualisez votre évolution, identifiez vos points forts et les domaines à améliorer avec nos outils d'analyse.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">Disponible 24/7</h3>
                    <p class="feature-description">
                        Apprenez quand vous voulez, où vous voulez. School Agent est toujours là pour vous accompagner dans vos études.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Sécurisé & Fiable</h3>
                    <p class="feature-description">
                        Vos données sont protégées et votre apprentissage se fait dans un environnement sûr, bienveillant et sans jugement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Étudiants actifs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-label">Questions résolues</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Taux de satisfaction</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support disponible</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Prêt à révolutionner votre apprentissage ?</h2>
            <p class="cta-subtitle">
                Rejoignez des milliers d'étudiants qui utilisent déjà School Agent pour améliorer leurs résultats scolaires et leur compréhension.
            </p>
            <a href="/login" class="btn btn-primary btn-large">
                <i class="fas fa-user-plus"></i>
                Créer mon compte gratuitement
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 School Agent. Tous droits réservés. Fait avec ❤️ pour l'éducation et l'apprentissage.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active navigation link based on scroll position
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.scrollY >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Header background on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = 'var(--shadow)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = 'none';
            }
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .stat-item').forEach(el => {
            observer.observe(el);
        });

        // Welcome message animation
        setTimeout(() => {
            const title = document.querySelector('.hero-title');
            if (title) {
                title.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    title.style.transform = 'scale(1)';
                }, 300);
            }
        }, 1000);
    </script>
</body>
</html>