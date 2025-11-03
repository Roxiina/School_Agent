<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonctions d'aide pour les agents
function getAgentIcon($agent_type) {
    switch (strtolower($agent_type)) {
        case 'agent mathéo':
        case 'mathéo':
            return 'fas fa-calculator';
        case 'agent histoire':
        case 'histoire':
            return 'fas fa-landmark';
        case 'agent scolaire':
        case 'scolaire':
            return 'fas fa-graduation-cap';
        default:
            return 'fas fa-robot';
    }
}

function getAgentColor($agent_type) {
    switch (strtolower($agent_type)) {
        case 'agent mathéo':
        case 'mathéo':
            return 'from-blue-500 to-indigo-600';
        case 'agent histoire':
        case 'histoire':
            return 'from-orange-500 to-red-600';
        case 'agent scolaire':
        case 'scolaire':
            return 'from-green-500 to-emerald-600';
        default:
            return 'from-purple-500 to-violet-600';
    }
}

function getAgentBadgeClass($agent_type) {
    switch (strtolower($agent_type)) {
        case 'agent mathéo':
        case 'mathéo':
            return 'bg-blue-100 text-blue-800';
        case 'agent histoire':
        case 'histoire':
            return 'bg-orange-100 text-orange-800';
        case 'agent scolaire':
        case 'scolaire':
            return 'bg-green-100 text-green-800';
        default:
            return 'bg-purple-100 text-purple-800';
    }
}

function formatDate($date) {
    if (!$date) return 'Non définie';
    return date('d/m/Y H:i', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Conversations - School Agent Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-slide-up { animation: slideInUp 0.6s ease-out; }
        .animate-fade-in { animation: fadeIn 0.8s ease-out; }
        .animate-pulse-slow { animation: pulse 3s ease-in-out infinite; }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15);
        }
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .btn-glow:hover::before {
            left: 100%;
        }
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 15s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-green-50 to-emerald-50 min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape w-20 h-20 bg-green-400 rounded-full top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="shape w-32 h-32 bg-emerald-400 rounded-full top-1/3 right-10" style="animation-delay: 5s;"></div>
        <div class="shape w-24 h-24 bg-teal-400 rounded-full bottom-20 left-1/4" style="animation-delay: 10s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-50 border-b border-green-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo Admin -->
                <div class="flex items-center gap-4">
                    <a href="?page=admin" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition">
                            <i class="fas fa-shield-alt text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">Admin Panel</span>
                    </a>
                    
                    <!-- Separateur -->
                    <div class="h-8 w-px bg-gray-300 ml-4"></div>
                    
                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 ml-4">
                        <a href="?page=admin" class="text-gray-600 hover:text-green-600 transition">Dashboard</a>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                        <span class="text-green-600 font-semibold">Conversations</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="?page=admin" class="flex items-center gap-2 text-gray-700 hover:text-green-600 transition font-medium">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="?page=admin&section=users" class="flex items-center gap-2 text-gray-700 hover:text-green-600 transition font-medium">
                        <i class="fas fa-users"></i> Utilisateurs
                    </a>
                    <a href="?page=admin&section=conversations" class="flex items-center gap-2 text-green-600 font-semibold">
                        <i class="fas fa-comments"></i> Conversations
                    </a>
                </div>

                <!-- User Info & Actions -->
                <div class="flex items-center gap-4">
                    <a href="?page=home" class="text-gray-700 hover:text-indigo-600 transition font-medium flex items-center gap-2">
                        <i class="fas fa-home"></i> Site
                    </a>
                    
                    <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></p>
                            <p class="text-xs text-green-600 font-medium">Administrateur</p>
                        </div>
                        <a href="?page=logout" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold btn-glow">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="animate-slide-up">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <div class="relative">
                    <!-- Admin Icon -->
                    <div class="w-32 h-32 bg-gradient-to-br from-green-600 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 animate-pulse-slow">
                        <i class="fas fa-comments text-white text-5xl"></i>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">
                        <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                            Gestion des Conversations
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-8">
                        Surveillez et modérez les interactions entre les utilisateurs et les agents IA de votre plateforme éducative.
                    </p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-calculator text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($conversations ?? [], fn($c) => strpos(strtolower($c['agent_type'] ?? ''), 'mathéo') !== false)); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Agent Mathéo</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-landmark text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($conversations ?? [], fn($c) => strpos(strtolower($c['agent_type'] ?? ''), 'histoire') !== false)); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Agent Histoire</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($conversations ?? [], fn($c) => strpos(strtolower($c['agent_type'] ?? ''), 'scolaire') !== false)); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Agent Scolaire</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-comments text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count($conversations ?? []); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters Section -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 border border-gray-100">
                <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                    <div class="flex flex-col sm:flex-row gap-4 items-center w-full lg:w-auto">
                        <div class="relative w-full sm:w-auto">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" id="searchConversations" placeholder="Rechercher une conversation..." 
                                   class="pl-12 pr-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-transparent w-full sm:w-80 text-lg">
                        </div>
                        <select id="filterAgent" class="border-2 border-gray-200 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-green-500 text-lg w-full sm:w-auto">
                            <option value="">Tous les agents</option>
                            <option value="mathéo">Agent Mathéo</option>
                            <option value="histoire">Agent Histoire</option>
                            <option value="scolaire">Agent Scolaire</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-4">
                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-download text-xl"></i> Exporter
                        </button>
                        <button class="bg-gradient-to-r from-purple-600 to-violet-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-chart-bar text-xl"></i> Statistiques
                        </button>
                    </div>
                </div>
            </div>

            <!-- Conversations Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <?php if (!empty($conversations)): ?>
                    <?php foreach ($conversations as $conversation): ?>
                        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 card-hover conversation-card" 
                             data-agent="<?php echo strtolower($conversation['agent_type'] ?? ''); ?>"
                             data-search="<?php echo strtolower(($conversation['user_nom'] ?? '') . ' ' . ($conversation['user_prenom'] ?? '') . ' ' . ($conversation['agent_type'] ?? '') . ' ' . ($conversation['sujet'] ?? '')); ?>">
                            
                            <!-- Conversation Header -->
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gradient-to-br <?php echo getAgentColor($conversation['agent_type'] ?? ''); ?> rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="<?php echo getAgentIcon($conversation['agent_type'] ?? ''); ?> text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                                            <?php echo htmlspecialchars($conversation['agent_type'] ?? 'Agent Inconnu'); ?>
                                        </h3>
                                        <p class="text-gray-600">
                                            avec <?php echo htmlspecialchars(($conversation['user_nom'] ?? '') . ' ' . ($conversation['user_prenom'] ?? 'Utilisateur inconnu')); ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold <?php echo getAgentBadgeClass($conversation['agent_type'] ?? ''); ?>">
                                    <i class="<?php echo getAgentIcon($conversation['agent_type'] ?? ''); ?> mr-2"></i>
                                    Agent IA
                                </span>
                            </div>

                            <!-- Conversation Details -->
                            <div class="space-y-4 mb-6">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold text-gray-600">SUJET DE CONVERSATION</span>
                                        <span class="text-xs text-gray-500">#<?php echo $conversation['id_conversation'] ?? 'N/A'; ?></span>
                                    </div>
                                    <p class="text-gray-900 font-medium">
                                        <?php echo htmlspecialchars($conversation['sujet'] ?? 'Sujet non défini'); ?>
                                    </p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <span class="text-sm font-semibold text-gray-600 block mb-1">DATE DE CRÉATION</span>
                                        <span class="text-gray-900 font-medium"><?php echo formatDate($conversation['date_creation'] ?? null); ?></span>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <span class="text-sm font-semibold text-gray-600 block mb-1">MESSAGES</span>
                                        <span class="text-gray-900 font-medium"><?php echo $conversation['message_count'] ?? '0'; ?> messages</span>
                                    </div>
                                </div>

                                <?php if (!empty($conversation['dernier_message'])): ?>
                                <div class="bg-blue-50 rounded-xl p-4 border-l-4 border-blue-400">
                                    <span class="text-sm font-semibold text-blue-600 block mb-2">DERNIER MESSAGE</span>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        <?php echo htmlspecialchars(substr($conversation['dernier_message'], 0, 150)); ?>
                                        <?php if (strlen($conversation['dernier_message']) > 150): ?>...<?php endif; ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <a href="?page=conversation&id=<?php echo $conversation['id_conversation'] ?? ''; ?>" 
                                   class="flex-1 py-3 px-4 bg-green-100 text-green-600 rounded-xl hover:bg-green-200 transition-all duration-300 font-bold text-center">
                                    <i class="fas fa-eye mr-2"></i> Voir détails
                                </a>
                                
                                <button class="px-4 py-3 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition-all duration-300"
                                        title="Exporter la conversation">
                                    <i class="fas fa-download"></i>
                                </button>
                                
                                <form method="POST" action="?page=admin/delete-conversation" class="inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?')">
                                    <input type="hidden" name="conversation_id" value="<?php echo $conversation['id_conversation'] ?? ''; ?>">
                                    <button type="submit" 
                                            class="px-4 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-all duration-300"
                                            title="Supprimer la conversation">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-20">
                        <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-comments text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune conversation trouvée</h3>
                            <p class="text-gray-600 mb-6">Les conversations apparaîtront ici quand les utilisateurs interagiront avec les agents.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Bottom Navigation -->
            <div class="text-center">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="?page=admin" class="inline-flex items-center px-8 py-3 bg-white text-gray-700 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 border border-gray-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour au dashboard
                    </a>
                    
                    <a href="?page=admin&section=users" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                        <i class="fas fa-users mr-2"></i>
                        Gérer les utilisateurs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-600 to-emerald-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">School Agent Admin</span>
                </div>
                <p class="text-gray-600">© 2025 School Agent. Panel d'administration.</p>
            </div>
        </div>
    </footer>

    <script>
        // Search functionality
        document.getElementById('searchConversations')?.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.conversation-card');
            
            cards.forEach(card => {
                const searchData = card.getAttribute('data-search');
                card.style.display = searchData.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Agent filter
        document.getElementById('filterAgent')?.addEventListener('change', function() {
            const selectedAgent = this.value;
            const cards = document.querySelectorAll('.conversation-card');
            
            cards.forEach(card => {
                if (!selectedAgent) {
                    card.style.display = 'block';
                } else {
                    const agent = card.getAttribute('data-agent');
                    card.style.display = agent.includes(selectedAgent) ? 'block' : 'none';
                }
            });
        });
    </script>
</body>
</html>