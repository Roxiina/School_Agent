<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Agent - Assistant IA Éducatif</title>
    <meta name="description" content="Plateforme éducative intelligente avec agents IA spécialisés pour accompagner votre apprentissage">
    
    <!-- CSS Framework -->
    <link rel="stylesheet" href="/app/front/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-light">
    
    <!-- Include Header -->
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container mx-auto px-6 text-center">
            <div class="animate-on-scroll">
                <h1 class="hero-title mb-6">
                    Votre Assistant IA Éducatif
                    <span class="text-gradient bg-gradient-blue">Intelligent</span>
                </h1>
                
                <p class="hero-subtitle mb-8">
                    Découvrez une nouvelle façon d'apprendre avec nos agents IA spécialisés. 
                    Mathématiques, Histoire, et Méthodologie scolaire - tout pour réussir !
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="/agents" class="btn btn-primary btn-glow">
                        <i class="fas fa-rocket mr-2"></i>
                        Commencer maintenant
                    </a>
                    
                    <a href="/about" class="btn btn-outline">
                        <i class="fas fa-info-circle mr-2"></i>
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="floating-element" style="top: 20%; left: 10%; animation-delay: 0s;">
            <i class="fas fa-calculator text-blue-400 text-3xl opacity-20"></i>
        </div>
        <div class="floating-element" style="top: 60%; right: 15%; animation-delay: 1s;">
            <i class="fas fa-landmark text-purple-400 text-4xl opacity-20"></i>
        </div>
        <div class="floating-element" style="top: 40%; right: 25%; animation-delay: 2s;">
            <i class="fas fa-graduation-cap text-green-400 text-3xl opacity-20"></i>
        </div>
    </section>

    <!-- Agents Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="section-title mb-6">
                    Nos Agents IA Spécialisés
                </h2>
                <p class="section-subtitle">
                    Chaque agent est expert dans son domaine pour vous offrir 
                    l'accompagnement le plus adapté à vos besoins.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Agent Mathéo -->
                <div class="agent-card agent-matheo animate-on-scroll" data-agent="agent-matheo">
                    <div class="agent-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Agent Mathéo
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Expert en mathématiques, de l'arithmétique de base jusqu'aux concepts avancés. 
                        Explications claires et exercices personnalisés.
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Spécialités</span>
                            <span class="font-semibold text-gray-900">Algèbre, Géométrie, Analyse</span>
                        </div>
                    </div>
                    
                    <a href="/conversation/agent/1" class="btn btn-primary w-full btn-glow">
                        <i class="fas fa-comments mr-2"></i>
                        Démarrer une conversation
                    </a>
                </div>

                <!-- Agent Histoire -->
                <div class="agent-card agent-histoire animate-on-scroll" data-agent="agent-histoire">
                    <div class="agent-icon">
                        <i class="fas fa-landmark"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Agent Histoire
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Passionné d'histoire, je vous accompagne dans la découverte du passé. 
                        Récits captivants et analyses approfondies.
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Spécialités</span>
                            <span class="font-semibold text-gray-900">Antiquité, Moyen-Âge, Moderne</span>
                        </div>
                    </div>
                    
                    <a href="/conversation/agent/2" class="btn btn-primary w-full btn-glow">
                        <i class="fas fa-comments mr-2"></i>
                        Démarrer une conversation
                    </a>
                </div>

                <!-- Agent Scolaire -->
                <div class="agent-card agent-scolaire animate-on-scroll" data-agent="agent-scolaire">
                    <div class="agent-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Agent Scolaire
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Votre coach en méthodologie scolaire. Organisation, techniques d'étude 
                        et gestion du stress pour optimiser vos résultats.
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Spécialités</span>
                            <span class="font-semibold text-gray-900">Planning, Révisions, Motivation</span>
                        </div>
                    </div>
                    
                    <a href="/conversation/agent/3" class="btn btn-primary w-full btn-glow">
                        <i class="fas fa-comments mr-2"></i>
                        Démarrer une conversation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="section-title mb-6">
                    Pourquoi Choisir School Agent ?
                </h2>
                <p class="section-subtitle">
                    Une plateforme conçue pour maximiser votre potentiel d'apprentissage
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-blue">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">IA Avancée</h3>
                    <p class="text-gray-600">
                        Technologie d'intelligence artificielle de pointe pour des réponses 
                        précises et personnalisées à vos questions.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-purple">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">24h/24 Disponible</h3>
                    <p class="text-gray-600">
                        Nos agents IA sont disponibles à tout moment pour vous accompagner 
                        dans votre apprentissage, sans contrainte d'horaires.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-green">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Suivi Personnalisé</h3>
                    <p class="text-gray-600">
                        Suivez vos progrès et recevez des recommandations adaptées 
                        à votre niveau et vos objectifs d'apprentissage.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-red">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Communauté Active</h3>
                    <p class="text-gray-600">
                        Rejoignez une communauté d'apprenants motivés et partagez 
                        vos expériences avec d'autres étudiants.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-yellow">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Multi-plateforme</h3>
                    <p class="text-gray-600">
                        Accédez à vos cours et conversations depuis n'importe quel 
                        appareil : ordinateur, tablette ou smartphone.
                    </p>
                </div>

                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon bg-gradient-indigo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sécurisé</h3>
                    <p class="text-gray-600">
                        Vos données sont protégées par les plus hauts standards 
                        de sécurité et de confidentialité.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="section-title mb-6">
                    School Agent en Chiffres
                </h2>
                <p class="section-subtitle">
                    La confiance de milliers d'étudiants à travers le monde
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon bg-gradient-blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">10,000+</h3>
                        <p>Étudiants actifs</p>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon bg-gradient-green">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">500,000+</h3>
                        <p>Conversations menées</p>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon bg-gradient-purple">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">4.9/5</h3>
                        <p>Note de satisfaction</p>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon bg-gradient-red">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">95%</h3>
                        <p>Taux de réussite</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-blue text-white relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Prêt à Transformer Votre Apprentissage ?
                </h2>
                
                <p class="text-xl mb-8 opacity-90">
                    Rejoignez des milliers d'étudiants qui ont déjà fait confiance à nos agents IA 
                    pour améliorer leurs résultats scolaires.
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="/register" class="btn btn-white btn-glow">
                        <i class="fas fa-user-plus mr-2"></i>
                        Créer un compte gratuit
                    </a>
                    
                    <a href="/demo" class="btn btn-outline-white">
                        <i class="fas fa-play mr-2"></i>
                        Voir la démonstration
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="floating-element" style="top: 10%; left: 10%; animation-delay: 0s;">
                <i class="fas fa-atom text-white text-6xl"></i>
            </div>
            <div class="floating-element" style="top: 20%; right: 20%; animation-delay: 1s;">
                <i class="fas fa-dna text-white text-5xl"></i>
            </div>
            <div class="floating-element" style="bottom: 20%; left: 20%; animation-delay: 2s;">
                <i class="fas fa-microscope text-white text-4xl"></i>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript -->
    <script src="/app/front/js/app.js"></script>
    
    <!-- Initialize App -->
    <script>
        // Initialize School Agent Application
        document.addEventListener('DOMContentLoaded', function() {
            const app = new SchoolAgent();
            app.init();
            
            // Agent card interactions
            const agentCards = document.querySelectorAll('.agent-card');
            agentCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
            
            // Smooth scroll for navigation links
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
            
            // Counter animation for statistics
            const animateCounters = () => {
                const counters = document.querySelectorAll('.stat-number');
                counters.forEach(counter => {
                    const target = counter.textContent.replace(/[^\d]/g, '');
                    const increment = target / 100;
                    let current = 0;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = counter.textContent.replace(/[\d,]+/, target.toLocaleString());
                            clearInterval(timer);
                        } else {
                            counter.textContent = counter.textContent.replace(/[\d,]+/, Math.floor(current).toLocaleString());
                        }
                    }, 20);
                });
            };
            
            // Trigger counter animation when statistics section comes into view
            const statsSection = document.querySelector('.stat-card');
            if (statsSection) {
                const observer = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        animateCounters();
                        observer.unobserve(statsSection);
                    }
                });
                observer.observe(statsSection);
            }
        });
    </script>
</body>
</html>