<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Récupérer la section demandée
$section = $_GET['section'] ?? 'dashboard';

// Fonctions d'aide pour les statistiques
function getStatCardClass($type) {
    $classes = [
        'users' => 'from-blue-500 to-blue-600',
        'conversations' => 'from-green-500 to-green-600',
        'recent' => 'from-purple-500 to-purple-600',
        'activity' => 'from-orange-500 to-orange-600'
    ];
    return $classes[$type] ?? 'from-gray-500 to-gray-600';
}

function getStatIcon($type) {
    $icons = [
        'users' => 'fas fa-users',
        'conversations' => 'fas fa-comments',
        'recent' => 'fas fa-clock',
        'activity' => 'fas fa-chart-line'
    ];
    return $icons[$type] ?? 'fas fa-chart-bar';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - School Agent</title>
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
        .animate-slide-up { animation: slideInUp 0.6s ease-out; }
        .animate-fade-in { animation: fadeIn 0.8s ease-out; }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">
    
    <!-- Navigation Admin -->
    <nav class="bg-white/90 backdrop-blur-lg shadow-lg sticky top-0 z-50 border-b border-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo Admin -->
                <div class="flex items-center gap-4">
                    <a href="?page=admin" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-pink-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition">
                            <i class="fas fa-shield-alt text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">Admin Panel</span>
                    </a>
                    
                    <!-- Separateur -->
                    <div class="h-8 w-px bg-gray-300 ml-4"></div>
                    
                    <!-- Navigation principale -->
                    <div class="hidden md:flex items-center gap-6 ml-4">
                        <a href="?page=admin&section=dashboard" 
                           class="flex items-center gap-2 <?php echo $section === 'dashboard' ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600'; ?> transition">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="?page=admin&section=users" 
                           class="flex items-center gap-2 <?php echo $section === 'users' ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600'; ?> transition">
                            <i class="fas fa-users"></i> Utilisateurs
                        </a>
                        <a href="?page=admin&section=conversations" 
                           class="flex items-center gap-2 <?php echo $section === 'conversations' ? 'text-red-600 font-semibold' : 'text-gray-700 hover:text-red-600'; ?> transition">
                            <i class="fas fa-comments"></i> Conversations
                        </a>
                    </div>
                </div>

                <!-- User Info & Actions -->
                <div class="flex items-center gap-4">
                    <a href="?page=home" class="text-gray-700 hover:text-indigo-600 transition font-medium flex items-center gap-2">
                        <i class="fas fa-home"></i> Site
                    </a>
                    
                    <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></p>
                            <p class="text-xs text-red-600 font-medium">Administrateur</p>
                        </div>
                        <a href="?page=logout" class="bg-gradient-to-r from-red-600 to-pink-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <?php if ($section === 'dashboard'): ?>
            <!-- Dashboard -->
            <div class="animate-slide-up">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Tableau de bord</h1>
                    <p class="text-gray-600">Vue d'ensemble de l'activité de School Agent</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Utilisateurs</p>
                                <p class="text-3xl font-bold text-gray-900"><?php echo $stats['totalUsers'] ?? 0; ?></p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br <?php echo getStatCardClass('users'); ?> rounded-2xl flex items-center justify-center">
                                <i class="<?php echo getStatIcon('users'); ?> text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Conversations -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Conversations</p>
                                <p class="text-3xl font-bold text-gray-900"><?php echo $stats['totalConversations'] ?? 0; ?></p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br <?php echo getStatCardClass('conversations'); ?> rounded-2xl flex items-center justify-center">
                                <i class="<?php echo getStatIcon('conversations'); ?> text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Nouveaux (24h)</p>
                                <p class="text-3xl font-bold text-gray-900"><?php echo $stats['recentUsers'] ?? 0; ?></p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br <?php echo getStatCardClass('recent'); ?> rounded-2xl flex items-center justify-center">
                                <i class="<?php echo getStatIcon('recent'); ?> text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Activity -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Activité</p>
                                <p class="text-3xl font-bold text-green-600">Élevée</p>
                            </div>
                            <div class="w-16 h-16 bg-gradient-to-br <?php echo getStatCardClass('activity'); ?> rounded-2xl flex items-center justify-center">
                                <i class="<?php echo getStatIcon('activity'); ?> text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Users by Role -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-user-tag text-indigo-600"></i>
                            Répartition par rôle
                        </h3>
                        
                        <?php if (!empty($stats['usersByRole'])): ?>
                            <div class="space-y-4">
                                <?php foreach ($stats['usersByRole'] as $roleData): ?>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700 font-medium capitalize">
                                            <?php echo ucfirst($roleData['role']); ?>
                                        </span>
                                        <div class="flex items-center gap-3">
                                            <div class="w-32 h-3 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full" 
                                                     style="width: <?php echo ($roleData['count'] / max(1, $stats['totalUsers'])) * 100; ?>%"></div>
                                            </div>
                                            <span class="text-gray-900 font-bold w-8 text-right"><?php echo $roleData['count']; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-center py-4">Aucune donnée disponible</p>
                        <?php endif; ?>
                    </div>

                    <!-- Users by Level -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-green-600"></i>
                            Répartition par niveau
                        </h3>
                        
                        <?php if (!empty($stats['usersByLevel'])): ?>
                            <div class="space-y-4">
                                <?php foreach ($stats['usersByLevel'] as $levelData): ?>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700 font-medium">
                                            <?php echo htmlspecialchars($levelData['niveau']); ?>
                                        </span>
                                        <div class="flex items-center gap-3">
                                            <div class="w-32 h-3 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" 
                                                     style="width: <?php echo ($levelData['count'] / max(1, $stats['totalUsers'])) * 100; ?>%"></div>
                                            </div>
                                            <span class="text-gray-900 font-bold w-8 text-right"><?php echo $levelData['count']; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-center py-4">Aucune donnée disponible</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-clock text-orange-600"></i>
                        Activité récente
                    </h3>
                    
                    <?php if (!empty($stats['recentConversations'])): ?>
                        <div class="space-y-4">
                            <?php foreach ($stats['recentConversations'] as $conversation): ?>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-comment text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900"><?php echo htmlspecialchars($conversation['titre']); ?></p>
                                            <p class="text-sm text-gray-600">
                                                par <?php echo htmlspecialchars($conversation['user_nom'] . ' ' . $conversation['user_prenom']); ?>
                                                avec <?php echo htmlspecialchars($conversation['agent_nom']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500">
                                        <?php echo date('d/m/Y H:i', strtotime($conversation['date_creation'])); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="text-center mt-6">
                            <a href="?page=admin&section=conversations" 
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                                <i class="fas fa-eye"></i>
                                Voir toutes les conversations
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">Aucune conversation récente</p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($section === 'users'): ?>
            <!-- Include users management page -->
            <?php include __DIR__ . '/admin/users.php'; ?>

        <?php elseif ($section === 'conversations'): ?>
            <!-- Include conversations management page -->
            <?php include __DIR__ . '/admin/conversations.php'; ?>

        <?php else: ?>
            <!-- Section not found -->
            <div class="text-center py-20">
                <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Section introuvable</h3>
                    <p class="text-gray-600 mb-6">Cette section d'administration n'existe pas.</p>
                    <a href="?page=admin" class="inline-block bg-gradient-to-r from-red-600 to-pink-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                        Retour au dashboard
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Quick Actions -->
        <div class="fixed bottom-6 right-6 flex flex-col gap-4">
            <a href="?page=admin&section=users" 
               class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition group">
                <i class="fas fa-users text-lg group-hover:scale-110 transition-transform"></i>
            </a>
            <a href="?page=admin&section=conversations" 
               class="w-14 h-14 bg-gradient-to-br from-green-600 to-emerald-600 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition group">
                <i class="fas fa-comments text-lg group-hover:scale-110 transition-transform"></i>
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-pink-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">School Agent Admin</span>
                </div>
                <p class="text-gray-600">© 2025 School Agent. Panel d'administration.</p>
            </div>
        </div>
    </footer>
</body>
</html>
