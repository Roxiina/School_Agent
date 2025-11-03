<?php
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();

// Fonctions d'aide pour les icônes utilisateur
function getUserRoleIcon($role) {
    switch ($role) {
        case 'admin':
            return 'fas fa-shield-alt';
        case 'professeur':
            return 'fas fa-chalkboard-teacher';
        case 'etudiant':
            return 'fas fa-user-graduate';
        default:
            return 'fas fa-user';
    }
}

function getUserRoleColor($role) {
    switch ($role) {
        case 'admin':
            return 'from-red-500 to-pink-600';
        case 'professeur':
            return 'from-blue-500 to-indigo-600';
        case 'etudiant':
            return 'from-green-500 to-emerald-600';
        default:
            return 'from-gray-500 to-gray-600';
    }
}

function getUserRoleBadgeClass($role) {
    switch ($role) {
        case 'admin':
            return 'bg-red-100 text-red-800';
        case 'professeur':
            return 'bg-blue-100 text-blue-800';
        case 'etudiant':
            return 'bg-green-100 text-green-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - School Agent Admin</title>
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
<body class="bg-gradient-to-br from-slate-50 via-red-50 to-pink-50 min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape w-20 h-20 bg-red-400 rounded-full top-10 left-10" style="animation-delay: 0s;"></div>
        <div class="shape w-32 h-32 bg-pink-400 rounded-full top-1/3 right-10" style="animation-delay: 5s;"></div>
        <div class="shape w-24 h-24 bg-orange-400 rounded-full bottom-20 left-1/4" style="animation-delay: 10s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-50 border-b border-red-100">
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
                    
                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 ml-4">
                        <a href="?page=admin" class="text-gray-600 hover:text-red-600 transition">Dashboard</a>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                        <span class="text-red-600 font-semibold">Utilisateurs</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="?page=admin" class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition font-medium">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="?page=admin&section=users" class="flex items-center gap-2 text-red-600 font-semibold">
                        <i class="fas fa-users"></i> Utilisateurs
                    </a>
                    <a href="?page=admin&section=conversations" class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition font-medium">
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
                            <p class="text-xs text-red-600 font-medium">Administrateur</p>
                        </div>
                        <a href="?page=logout" class="bg-gradient-to-r from-red-600 to-pink-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold btn-glow">
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
                    <div class="w-32 h-32 bg-gradient-to-br from-red-600 to-pink-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 animate-pulse-slow">
                        <i class="fas fa-users text-white text-5xl"></i>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">
                        <span class="bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                            Gestion des Utilisateurs
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-8">
                        Administrez les comptes utilisateurs, gérez les rôles et surveillez l'activité de votre plateforme éducative.
                    </p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user-graduate text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'etudiant')); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Étudiants</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'professeur')); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Professeurs</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'admin')); ?>
                            </p>
                            <p class="text-gray-600 font-medium">Administrateurs</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 card-hover">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <?php echo count($users ?? []); ?>
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
                            <input type="text" id="searchUsers" placeholder="Rechercher un utilisateur..." 
                                   class="pl-12 pr-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-transparent w-full sm:w-80 text-lg">
                        </div>
                        <select id="filterRole" class="border-2 border-gray-200 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-red-500 text-lg w-full sm:w-auto">
                            <option value="">Tous les rôles</option>
                            <option value="admin">Administrateurs</option>
                            <option value="professeur">Professeurs</option>
                            <option value="etudiant">Étudiants</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-4">
                        <button class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-plus text-xl"></i> Nouvel utilisateur
                        </button>
                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 btn-glow inline-flex items-center gap-3">
                            <i class="fas fa-download text-xl"></i> Exporter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Users Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 card-hover user-card" 
                             data-role="<?php echo strtolower($user['role']); ?>"
                             data-name="<?php echo strtolower($user['nom'] . ' ' . $user['prenom'] . ' ' . $user['email']); ?>">
                            
                            <!-- User Avatar & Info -->
                            <div class="text-center mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br <?php echo getUserRoleColor($user['role']); ?> rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <i class="<?php echo getUserRoleIcon($user['role']); ?> text-white text-3xl"></i>
                                </div>
                                
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                    <?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?>
                                </h3>
                                
                                <p class="text-gray-600 mb-3"><?php echo htmlspecialchars($user['email']); ?></p>
                                
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold <?php echo getUserRoleBadgeClass($user['role']); ?>">
                                    <i class="<?php echo getUserRoleIcon($user['role']); ?> mr-2"></i>
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </div>

                            <!-- User Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <span class="text-gray-600 font-medium">ID Utilisateur</span>
                                    <span class="text-gray-900 font-bold">#<?php echo $user['id_user']; ?></span>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <span class="text-gray-600 font-medium">Niveau</span>
                                    <span class="text-gray-900 font-bold"><?php echo htmlspecialchars($user['niveau_scolaire'] ?? 'Non défini'); ?></span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <!-- Toggle Role Button -->
                                <form method="POST" action="?page=admin/toggle-user-role" class="flex-1">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>">
                                    <button type="submit" 
                                            class="w-full py-3 rounded-xl font-bold transition-all duration-300 <?php echo $user['role'] === 'admin' ? 'bg-orange-100 text-orange-600 hover:bg-orange-200' : 'bg-blue-100 text-blue-600 hover:bg-blue-200'; ?>"
                                            title="<?php echo $user['role'] === 'admin' ? 'Retirer les droits admin' : 'Promouvoir admin'; ?>">
                                        <i class="fas fa-<?php echo $user['role'] === 'admin' ? 'user-minus' : 'user-plus'; ?> mr-2"></i>
                                        <?php echo $user['role'] === 'admin' ? 'Rétrograder' : 'Promouvoir'; ?>
                                    </button>
                                </form>
                                
                                <!-- Edit Button -->
                                <button class="px-4 py-3 bg-indigo-100 text-indigo-600 rounded-xl hover:bg-indigo-200 transition-all duration-300"
                                        title="Modifier l'utilisateur">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <!-- Delete Button -->
                                <form method="POST" action="?page=admin/delete-user" class="inline" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>">
                                    <button type="submit" 
                                            class="px-4 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-all duration-300"
                                            title="Supprimer l'utilisateur"
                                            <?php echo $user['role'] === 'admin' ? 'disabled' : ''; ?>>
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
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun utilisateur trouvé</h3>
                            <p class="text-gray-600 mb-6">Commencez par ajouter des utilisateurs à votre plateforme.</p>
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
                    
                    <a href="?page=admin&section=conversations" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200 btn-glow">
                        <i class="fas fa-comments mr-2"></i>
                        Gérer les conversations
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
                    <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-pink-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">School Agent Admin</span>
                </div>
                <p class="text-gray-600">© 2025 School Agent. Panel d'administration.</p>
            </div>
        </div>
    </footer>

    <script>
        // Search functionality
        document.getElementById('searchUsers')?.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.user-card');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                card.style.display = name.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Role filter
        document.getElementById('filterRole')?.addEventListener('change', function() {
            const selectedRole = this.value;
            const cards = document.querySelectorAll('.user-card');
            
            cards.forEach(card => {
                if (!selectedRole) {
                    card.style.display = 'block';
                } else {
                    const role = card.getAttribute('data-role');
                    card.style.display = role === selectedRole ? 'block' : 'none';
                }
            });
        });
    </script>
</body>
</html>