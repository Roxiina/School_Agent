<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - School Agent</title>
    <meta name="description" content="Tableau de bord administrateur School Agent">
    
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
    
    <!-- Include Components -->
    <?php include __DIR__ . '/../components/components.php'; ?>

    <!-- Admin Header -->
    <section class="py-8 bg-white shadow-sm">
        <div class="container mx-auto px-6">
            <?php 
            renderBreadcrumb([
                ['label' => 'Accueil', 'url' => '/home'],
                ['label' => 'Administration']
            ]); 
            ?>
            
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Tableau de Bord Administrateur
                    </h1>
                    <p class="text-gray-600">
                        Gérez votre plateforme School Agent
                    </p>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="px-4 py-2 bg-red-100 text-red-600 rounded-xl font-semibold">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Mode Admin
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Overview -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Vue d'ensemble</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <?php 
                renderStatCard('fas fa-users', '1,247', 'Utilisateurs Total', 'blue');
                renderStatCard('fas fa-comments', '8,542', 'Conversations', 'green');
                renderStatCard('fas fa-graduation-cap', '3', 'Agents IA', 'purple');
                renderStatCard('fas fa-chart-line', '+23%', 'Croissance', 'red');
                ?>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Actions Rapides</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gestion Utilisateurs -->
                <a href="/admin/user" class="admin-quick-action admin-users">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-red rounded-2xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Gestion des Utilisateurs
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Créer, modifier et gérer les comptes utilisateurs
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">1,247 utilisateurs</span>
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">
                            Actif
                        </span>
                    </div>
                </a>

                <!-- Gestion Conversations -->
                <a href="/admin/conversation" class="admin-quick-action admin-conversations">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-green rounded-2xl flex items-center justify-center">
                            <i class="fas fa-comments text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Conversations
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Suivre et modérer les interactions avec les agents IA
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">8,542 conversations</span>
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">
                            Surveillé
                        </span>
                    </div>
                </a>

                <!-- Gestion Agents -->
                <a href="/admin/agent" class="admin-quick-action admin-agents">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-purple rounded-2xl flex items-center justify-center">
                            <i class="fas fa-robot text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Agents IA
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Configurer et optimiser les agents éducatifs
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">3 agents actifs</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-semibold">
                            Opérationnel
                        </span>
                    </div>
                </a>

                <!-- Rapports -->
                <a href="/admin/report" class="admin-quick-action admin-reports">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-blue rounded-2xl flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Rapports & Analytics
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Analyser les performances et l'utilisation
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Données en temps réel</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-semibold">
                            Mis à jour
                        </span>
                    </div>
                </a>

                <!-- Paramètres -->
                <a href="/admin/setting" class="admin-quick-action admin-settings">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-yellow rounded-2xl flex items-center justify-center">
                            <i class="fas fa-cogs text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Paramètres Système
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Configuration générale de la plateforme
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Configuration</span>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-semibold">
                            Stable
                        </span>
                    </div>
                </a>

                <!-- Sécurité -->
                <a href="/admin/security" class="admin-quick-action admin-security">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-indigo rounded-2xl flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-400"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Sécurité & Logs
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        Surveiller la sécurité et les accès
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Surveillance active</span>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-xs font-semibold">
                            Sécurisé
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent Activity -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Users -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-user-plus text-red-500 mr-2"></i>
                            Nouveaux Utilisateurs
                        </h3>
                        <a href="/admin/user" class="text-sm text-blue-600 hover:text-blue-800 transition">
                            Voir tout
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-blue rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Marie Dubois</p>
                                    <p class="text-sm text-gray-600">marie@email.com</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 2h</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-green rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Pierre Martin</p>
                                    <p class="text-sm text-gray-600">pierre@email.com</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 5h</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-purple rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Sophie Leroy</p>
                                    <p class="text-sm text-gray-600">sophie@email.com</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Hier</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Conversations -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-comments text-green-500 mr-2"></i>
                            Conversations Récentes
                        </h3>
                        <a href="/admin/conversation" class="text-sm text-blue-600 hover:text-blue-800 transition">
                            Voir tout
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-matheo rounded-xl flex items-center justify-center">
                                    <i class="fas fa-calculator text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Aide en algèbre</p>
                                    <p class="text-sm text-gray-600">avec Agent Mathéo</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Actif</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-histoire rounded-xl flex items-center justify-center">
                                    <i class="fas fa-landmark text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Révolution française</p>
                                    <p class="text-sm text-gray-600">avec Agent Histoire</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 1h</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-scolaire rounded-xl flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Organisation des révisions</p>
                                    <p class="text-sm text-gray-600">avec Agent Scolaire</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">Il y a 3h</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript -->
    <script src="/app/front/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const app = new SchoolAgent();
            app.init();
            
            // Admin quick action interactions
            const quickActions = document.querySelectorAll('.admin-quick-action');
            quickActions.forEach(action => {
                action.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
                });
                
                action.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.05)';
                });
            });
            
            // Real-time updates simulation
            const updateStats = () => {
                const stats = document.querySelectorAll('.stat-number');
                stats.forEach(stat => {
                    // Simulate real-time updates with small random changes
                    if (Math.random() > 0.7) {
                        stat.classList.add('pulse');
                        setTimeout(() => {
                            stat.classList.remove('pulse');
                        }, 1000);
                    }
                });
            };
            
            // Update stats every 30 seconds
            setInterval(updateStats, 30000);
            
            // Add notification dot for admin mode
            const adminBadge = document.querySelector('.bg-red-100.text-red-600');
            if (adminBadge) {
                adminBadge.style.position = 'relative';
                adminBadge.innerHTML += '<span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>';
            }
        });
    </script>
</body>
</html>