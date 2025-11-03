<?php
\SchoolAgent\Config\Authenticator::startSession();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ?page=login');
    exit;
}

// Récupérer les agents disponibles depuis la base de données
use SchoolAgent\Models\AgentModel;
$agentModel = new AgentModel();
$agents = $agentModel->getAgents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Conversation - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .agent-card {
            transition: all 0.3s ease;
        }
        .agent-card:hover {
            transform: translateY(-2px);
        }
        .notification {
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-white min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-3xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="?page=conversation" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 mb-6 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span class="font-medium">Retour aux conversations</span>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-plus-circle text-indigo-600 mr-3"></i>Nouvelle Conversation
                    </h1>
                    <p class="text-gray-600">Créez une nouvelle conversation avec l'agent de votre choix</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                <form method="POST" class="p-8 space-y-6" onsubmit="return validateForm()">
                    <!-- Titre -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading text-indigo-600 mr-2"></i>Titre de la conversation
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Ex: Révision des équations du second degré"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200"
                        >
                        <p class="text-sm text-gray-500 mt-2">Donnez un titre descriptif à votre conversation</p>
                    </div>

                    <!-- Agent Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-robot text-indigo-600 mr-2"></i>Sélectionnez un agent
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php if (!empty($agents)): ?>
                                <?php foreach ($agents as $index => $agent): ?>
                                    <label class="relative agent-card">
                                        <input 
                                            type="radio" 
                                            name="agent_id" 
                                            value="<?php echo $agent['id_agent']; ?>" 
                                            <?php echo $index === 0 ? 'checked' : ''; ?>
                                            class="peer sr-only"
                                        >
                                        <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300 transition-all duration-200">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-robot text-white text-lg"></i>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="font-semibold text-gray-900 truncate"><?php echo htmlspecialchars($agent['nom']); ?></p>
                                                    <p class="text-sm text-gray-600 truncate"><?php echo htmlspecialchars($agent['description'] ?? 'Agent assistant'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-span-full p-6 text-center text-gray-500">
                                    <i class="fas fa-robot text-3xl mb-2"></i>
                                    <p>Aucun agent disponible</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-6">
                        <a href="?page=conversation" class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg transition-all duration-200"
                        >
                            <i class="fas fa-plus mr-2"></i>Créer la conversation
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-3">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i>Comment ça marche ?
                </h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-indigo-600 mt-1 text-xs"></i>
                        <span>Choisissez un titre descriptif pour votre conversation</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-indigo-600 mt-1 text-xs"></i>
                        <span>Sélectionnez l'agent qui correspond à votre besoin</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-indigo-600 mt-1 text-xs"></i>
                        <span>Cliquez sur "Créer la conversation" pour commencer</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Fonctions de notification (même système que la page conversation)
        function showSuccessMessage(message) {
            showNotification(message, 'success');
        }
        
        function showErrorMessage(message) {
            showNotification(message, 'error');
        }
        
        function showNotification(message, type = 'info') {
            const existingNotification = document.getElementById('notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            const notification = document.createElement('div');
            notification.id = 'notification';
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
                padding: 16px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
                display: flex;
                align-items: center;
                gap: 8px;
                max-width: 400px;
            `;
            
            if (type === 'success') {
                notification.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                notification.innerHTML = '<i class="fas fa-check-circle"></i>' + message;
            } else if (type === 'error') {
                notification.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
                notification.innerHTML = '<i class="fas fa-exclamation-circle"></i>' + message;
            } else {
                notification.style.background = 'linear-gradient(135deg, #3b82f6, #1d4ed8)';
                notification.innerHTML = '<i class="fas fa-info-circle"></i>' + message;
            }
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        // Validation du formulaire
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const selectedAgent = document.querySelector('input[name="agent_id"]:checked');
            
            if (!title) {
                showErrorMessage('Veuillez saisir un titre pour la conversation');
                return false;
            }
            
            if (title.length < 3) {
                showErrorMessage('Le titre doit contenir au moins 3 caractères');
                return false;
            }
            
            if (!selectedAgent) {
                showErrorMessage('Veuillez sélectionner un agent');
                return false;
            }
            
            // Animation du bouton pendant la soumission
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Création en cours...';
            
            return true;
        }

        // Afficher les messages d'erreur/succès de session si présents
        <?php if (isset($_SESSION['error']) && $_SESSION['error']): ?>
            showErrorMessage('<?php echo addslashes($_SESSION['error']); ?>');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['success']) && $_SESSION['success']): ?>
            showSuccessMessage('<?php echo addslashes($_SESSION['success']); ?>');
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>
</body>
</html>