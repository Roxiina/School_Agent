<?php
// Cette page sera incluse dans dashboard.php quand section=users
?>

<div class="animate-slide-up">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Gestion des utilisateurs</h1>
        <p class="text-gray-600">Administrer les comptes utilisateurs et leurs droits</p>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex gap-4 items-center">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchUsers" placeholder="Rechercher un utilisateur..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <select id="filterRole" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">Tous les rôles</option>
                    <option value="admin">Administrateurs</option>
                    <option value="professeur">Professeurs</option>
                    <option value="etudiant">Étudiants</option>
                </select>
            </div>
            
            <div class="flex gap-3">
                <button class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold flex items-center gap-2">
                    <i class="fas fa-plus"></i> Nouvel utilisateur
                </button>
                <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold flex items-center gap-2">
                    <i class="fas fa-download"></i> Exporter
                </button>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-users text-blue-600"></i>
                Liste des utilisateurs
                <span class="text-sm font-normal text-gray-500 ml-2">
                    (<?php echo count($users ?? []); ?> utilisateurs)
                </span>
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-4 font-semibold text-gray-900">Utilisateur</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Email</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Rôle</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Niveau</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                <?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?>
                                            </p>
                                            <p class="text-sm text-gray-500">ID: <?php echo $user['id_user']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="text-gray-700"><?php echo htmlspecialchars($user['email']); ?></span>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        <?php echo $user['role'] === 'admin' ? 'bg-red-100 text-red-800' : 
                                            ($user['role'] === 'professeur' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'); ?>">
                                        <i class="fas fa-<?php echo $user['role'] === 'admin' ? 'shield-alt' : 
                                            ($user['role'] === 'professeur' ? 'chalkboard-teacher' : 'user-graduate'); ?> mr-1"></i>
                                        <?php echo ucfirst($user['role']); ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="text-gray-700"><?php echo htmlspecialchars($user['niveau_scolaire'] ?? 'Non défini'); ?></span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Toggle Role Button -->
                                        <form method="POST" action="?page=admin/toggle-user-role" class="inline">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>">
                                            <button type="submit" 
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                                                           <?php echo $user['role'] === 'admin' ? 'bg-orange-100 text-orange-600 hover:bg-orange-200' : 'bg-blue-100 text-blue-600 hover:bg-blue-200'; ?>"
                                                    title="<?php echo $user['role'] === 'admin' ? 'Retirer les droits admin' : 'Promouvoir admin'; ?>">
                                                <i class="fas fa-<?php echo $user['role'] === 'admin' ? 'user-minus' : 'user-plus'; ?> text-sm"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- Edit Button -->
                                        <button class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center hover:bg-indigo-200 transition-colors"
                                                title="Modifier l'utilisateur">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        
                                        <!-- Delete Button -->
                                        <form method="POST" action="?page=admin/delete-user" class="inline" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>">
                                            <button type="submit" 
                                                    class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition-colors"
                                                    title="Supprimer l'utilisateur"
                                                    <?php echo $user['role'] === 'admin' ? 'disabled' : ''; ?>>
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-4">
                                    <i class="fas fa-users text-4xl text-gray-300"></i>
                                    <p class="text-lg">Aucun utilisateur trouvé</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'etudiant')); ?>
                    </p>
                    <p class="text-gray-600">Étudiants</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'professeur')); ?>
                    </p>
                    <p class="text-gray-600">Professeurs</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo count(array_filter($users ?? [], fn($u) => $u['role'] === 'admin')); ?>
                    </p>
                    <p class="text-gray-600">Administrateurs</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple search functionality
document.getElementById('searchUsers')?.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Role filter
document.getElementById('filterRole')?.addEventListener('change', function() {
    const selectedRole = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        if (!selectedRole) {
            row.style.display = '';
        } else {
            const roleCell = row.querySelector('td:nth-child(3)');
            const hasRole = roleCell && roleCell.textContent.toLowerCase().includes(selectedRole);
            row.style.display = hasRole ? '' : 'none';
        }
    });
});
</script>