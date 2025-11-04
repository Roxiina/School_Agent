<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Administration</title>
    <meta name="description" content="Interface d'administration pour la gestion des utilisateurs">
    
    <!-- CSS Framework -->
    <link rel="stylesheet" href="/app/front/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-light admin-theme-users">
    
    <!-- Include Header -->
    <?php include __DIR__ . '/../components/header.php'; ?>
    
    <!-- Include Components -->
    <?php include __DIR__ . '/../components/components.php'; ?>

    <!-- Page Header -->
    <section class="py-8 bg-white shadow-sm">
        <div class="container mx-auto px-6">
            <?php 
            renderBreadcrumb([
                ['label' => 'Accueil', 'url' => '/home'],
                ['label' => 'Administration', 'url' => '/admin'],
                ['label' => 'Gestion des Utilisateurs']
            ]); 
            ?>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-users text-red-500 mr-3"></i>
                        Gestion des Utilisateurs
                    </h1>
                    <p class="text-gray-600">
                        Créer, modifier et gérer tous les comptes utilisateurs de la plateforme
                    </p>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="btn btn-outline" onclick="exportUsers()">
                        <i class="fas fa-download mr-2"></i>
                        Exporter
                    </button>
                    
                    <button class="btn btn-red btn-glow" onclick="openCreateUserModal()">
                        <i class="fas fa-user-plus mr-2"></i>
                        Nouvel Utilisateur
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters & Search -->
    <section class="py-6 bg-white border-b">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Search Bar -->
                <div class="flex-1">
                    <?php renderSearchBar("Rechercher un utilisateur (nom, email, rôle)..."); ?>
                </div>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-4">
                    <!-- Role Filter -->
                    <div class="relative">
                        <select id="roleFilter" class="form-select">
                            <option value="">Tous les rôles</option>
                            <option value="admin">Administrateur</option>
                            <option value="professeur">Professeur</option>
                            <option value="etudiant">Étudiant</option>
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="relative">
                        <select id="statusFilter" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="active">Actif</option>
                            <option value="inactive">Inactif</option>
                            <option value="suspended">Suspendu</option>
                        </select>
                    </div>
                    
                    <!-- Reset Filters -->
                    <button class="btn btn-outline" onclick="resetFilters()">
                        <i class="fas fa-times mr-2"></i>
                        Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php 
                renderStatCard('fas fa-users', '1,247', 'Total Utilisateurs', 'red');
                renderStatCard('fas fa-shield-alt', '12', 'Administrateurs', 'red');
                renderStatCard('fas fa-chalkboard-teacher', '156', 'Professeurs', 'blue');
                renderStatCard('fas fa-user-graduate', '1,079', 'Étudiants', 'green');
                ?>
            </div>
        </div>
    </section>

    <!-- Users Grid -->
    <section class="py-8">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">
                    Liste des Utilisateurs
                </h2>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">
                        <span id="filteredCount">1,247</span> utilisateurs trouvés
                    </span>
                    
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600">Affichage:</label>
                        <select id="viewMode" class="form-select-sm">
                            <option value="grid">Grille</option>
                            <option value="list">Liste</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Users Grid Container -->
            <div id="usersContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                <!-- Sample User Cards -->
                <div class="card animate-on-scroll filterable-item" 
                     data-role="admin"
                     data-search="marie dubois admin marie.dubois@email.com">
                    
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-red rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-shield-alt text-white text-3xl"></i>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Marie Dubois
                        </h3>
                        
                        <p class="text-gray-600 mb-3">marie.dubois@email.com</p>
                        
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Administrateur
                        </span>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">ID Utilisateur</span>
                            <span class="text-gray-900 font-bold">#1001</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Statut</span>
                            <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-sm font-semibold">
                                Actif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Dernière connexion</span>
                            <span class="text-gray-900 font-medium text-sm">Aujourd'hui</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 px-3 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition font-bold text-sm" 
                                onclick="editUser(1001)">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </button>
                        
                        <button class="px-3 py-2 bg-yellow-100 text-yellow-600 rounded-xl hover:bg-yellow-200 transition font-bold text-sm"
                                onclick="viewUser(1001)">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        <button class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition font-bold text-sm"
                                onclick="deleteUser(1001)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- More sample users... -->
                <div class="card animate-on-scroll filterable-item" 
                     data-role="professeur"
                     data-search="pierre martin professeur pierre.martin@email.com">
                    
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-blue rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-chalkboard-teacher text-white text-3xl"></i>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Pierre Martin
                        </h3>
                        
                        <p class="text-gray-600 mb-3">pierre.martin@email.com</p>
                        
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            Professeur
                        </span>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">ID Utilisateur</span>
                            <span class="text-gray-900 font-bold">#1002</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Statut</span>
                            <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-sm font-semibold">
                                Actif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Matière</span>
                            <span class="text-gray-900 font-medium text-sm">Mathématiques</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 px-3 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition font-bold text-sm" 
                                onclick="editUser(1002)">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </button>
                        
                        <button class="px-3 py-2 bg-yellow-100 text-yellow-600 rounded-xl hover:bg-yellow-200 transition font-bold text-sm"
                                onclick="viewUser(1002)">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        <button class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition font-bold text-sm"
                                onclick="deleteUser(1002)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="card animate-on-scroll filterable-item" 
                     data-role="etudiant"
                     data-search="sophie leroy etudiant sophie.leroy@email.com">
                    
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-green rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user-graduate text-white text-3xl"></i>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Sophie Leroy
                        </h3>
                        
                        <p class="text-gray-600 mb-3">sophie.leroy@email.com</p>
                        
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                            <i class="fas fa-user-graduate mr-2"></i>
                            Étudiant
                        </span>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">ID Utilisateur</span>
                            <span class="text-gray-900 font-bold">#1003</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Statut</span>
                            <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-sm font-semibold">
                                Actif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-600 font-medium">Niveau</span>
                            <span class="text-gray-900 font-medium text-sm">Terminale S</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 py-2 px-3 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition font-bold text-sm" 
                                onclick="editUser(1003)">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </button>
                        
                        <button class="px-3 py-2 bg-yellow-100 text-yellow-600 rounded-xl hover:bg-yellow-200 transition font-bold text-sm"
                                onclick="viewUser(1003)">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        <button class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition font-bold text-sm"
                                onclick="deleteUser(1003)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div class="text-center mt-12">
                <button class="btn btn-outline" onclick="loadMoreUsers()">
                    <i class="fas fa-plus mr-2"></i>
                    Charger plus d'utilisateurs
                </button>
            </div>
        </div>
    </section>

    <!-- Create User Modal -->
    <div id="createUserModal" class="modal fixed inset-0 z-50 hidden">
        <div class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="modal-content bg-white rounded-2xl shadow-xl max-w-lg w-full max-h-screen overflow-y-auto">
                <div class="modal-header flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-user-plus text-red-500 mr-2"></i>
                        Créer un Nouvel Utilisateur
                    </h2>
                    <button class="modal-close text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <form id="createUserForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-input" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Adresse Email</label>
                            <input type="email" name="email" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-select" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="etudiant">Étudiant</option>
                                <option value="professeur">Professeur</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Mot de passe temporaire</label>
                            <input type="password" name="password" class="form-input" required>
                            <p class="text-sm text-gray-600 mt-1">L'utilisateur sera invité à le changer à sa première connexion</p>
                        </div>
                        
                        <div class="flex gap-4">
                            <button type="submit" class="btn btn-red flex-1">
                                <i class="fas fa-save mr-2"></i>
                                Créer l'utilisateur
                            </button>
                            <button type="button" class="btn btn-outline" onclick="closeModal('createUserModal')">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <!-- JavaScript -->
    <script src="/app/front/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const app = new SchoolAgent();
            app.init();
            
            // Initialize user management
            initializeUserManagement();
        });
        
        function initializeUserManagement() {
            // Filter functionality
            const roleFilter = document.getElementById('roleFilter');
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.querySelector('.search-input');
            
            [roleFilter, statusFilter, searchInput].forEach(element => {
                if (element) {
                    element.addEventListener('change', filterUsers);
                    element.addEventListener('input', filterUsers);
                }
            });
            
            // View mode toggle
            const viewMode = document.getElementById('viewMode');
            if (viewMode) {
                viewMode.addEventListener('change', toggleViewMode);
            }
        }
        
        function filterUsers() {
            const role = document.getElementById('roleFilter').value;
            const status = document.getElementById('statusFilter').value;
            const search = document.querySelector('.search-input').value.toLowerCase();
            
            const users = document.querySelectorAll('.filterable-item');
            let visibleCount = 0;
            
            users.forEach(user => {
                const userRole = user.dataset.role;
                const userSearch = user.dataset.search;
                
                const roleMatch = !role || userRole === role;
                const searchMatch = !search || userSearch.includes(search);
                
                if (roleMatch && searchMatch) {
                    user.style.display = 'block';
                    user.classList.add('animate-on-scroll');
                    visibleCount++;
                } else {
                    user.style.display = 'none';
                }
            });
            
            document.getElementById('filteredCount').textContent = visibleCount;
        }
        
        function resetFilters() {
            document.getElementById('roleFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.querySelector('.search-input').value = '';
            filterUsers();
        }
        
        function toggleViewMode() {
            const mode = document.getElementById('viewMode').value;
            const container = document.getElementById('usersContainer');
            
            if (mode === 'list') {
                container.className = 'space-y-4';
                // Add list view classes to cards
                container.querySelectorAll('.card').forEach(card => {
                    card.classList.add('flex', 'items-center', 'p-4');
                });
            } else {
                container.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
                // Remove list view classes from cards
                container.querySelectorAll('.card').forEach(card => {
                    card.classList.remove('flex', 'items-center', 'p-4');
                });
            }
        }
        
        function openCreateUserModal() {
            document.getElementById('createUserModal').classList.remove('hidden');
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        function editUser(userId) {
            alert(`Modifier l'utilisateur #${userId}`);
            // Implement edit functionality
        }
        
        function viewUser(userId) {
            alert(`Voir les détails de l'utilisateur #${userId}`);
            // Implement view functionality
        }
        
        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                alert(`Supprimer l'utilisateur #${userId}`);
                // Implement delete functionality
            }
        }
        
        function exportUsers() {
            alert('Export des utilisateurs en cours...');
            // Implement export functionality
        }
        
        function loadMoreUsers() {
            alert('Chargement de plus d\'utilisateurs...');
            // Implement load more functionality
        }
        
        // Modal event listeners
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-close') || e.target.classList.contains('modal-overlay')) {
                const modal = e.target.closest('.modal');
                if (modal) {
                    modal.classList.add('hidden');
                }
            }
        });
        
        // Create user form submission
        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const formData = new FormData(this);
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Création...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                alert('Utilisateur créé avec succès !');
                closeModal('createUserModal');
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    </script>
</body>
</html>