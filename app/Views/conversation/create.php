<?php
\SchoolAgent\Config\Authenticator::startSession();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ?page=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Conversation - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-2xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="?page=conversation" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 mb-6 font-semibold">
                    <i class="fas fa-arrow-left"></i>
                    Retour aux conversations
                </a>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-plus-circle text-indigo-600 mr-3"></i>Nouvelle Conversation
                    </h1>
                    <p class="text-gray-600">Créez une nouvelle conversation avec l'agent de votre choix</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <?php
                // Afficher les messages de succès/erreur
                if (isset($_SESSION['error']) && $_SESSION['error']): ?>
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <p><i class="fas fa-exclamation-circle mr-2"></i><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success']) && $_SESSION['success']): ?>
                    <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                        <p><i class="fas fa-check-circle mr-2"></i><?php echo htmlspecialchars($_SESSION['success']); ?></p>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form method="POST" class="p-8 space-y-6">
                    <!-- Titre -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-heading text-indigo-600 mr-2"></i>Titre de la Conversation
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Ex: Révision des équations du second degré"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 transition"
                        >
                        <p class="text-sm text-gray-500 mt-2">Donnez un titre descriptif à votre conversation</p>
                    </div>

                    <!-- Agent Selection -->
                    <div>
                        <label for="agent_id" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-robot text-indigo-600 mr-2"></i>Sélectionnez un Agent
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="relative">
                                <input 
                                    type="radio" 
                                    name="agent_id" 
                                    value="1" 
                                    checked
                                    class="peer sr-only"
                                >
                                <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-600 peer-checked:bg-indigo-50 hover:border-indigo-400 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-robot text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Agent Principal</p>
                                            <p class="text-sm text-gray-600">Assistant polyvalent</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative">
                                <input 
                                    type="radio" 
                                    name="agent_id" 
                                    value="2"
                                    class="peer sr-only"
                                >
                                <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-blue-400 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-calculator text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Math Expert</p>
                                            <p class="text-sm text-gray-600">Mathématiques spécialisé</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative">
                                <input 
                                    type="radio" 
                                    name="agent_id" 
                                    value="3"
                                    class="peer sr-only"
                                >
                                <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-amber-600 peer-checked:bg-amber-50 hover:border-amber-400 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-600 to-orange-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-book text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Histoire Expert</p>
                                            <p class="text-sm text-gray-600">Histoire & géographie</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative">
                                <input 
                                    type="radio" 
                                    name="agent_id" 
                                    value="4"
                                    class="peer sr-only"
                                >
                                <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-green-600 peer-checked:bg-green-50 hover:border-green-400 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-flask text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Sciences Expert</p>
                                            <p class="text-sm text-gray-600">Physique & chimie</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <a href="?page=conversation" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-indigo-500/50 transition"
                        >
                            <i class="fas fa-plus mr-2"></i>Créer la Conversation
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 p-6 bg-indigo-50 border border-indigo-200 rounded-lg">
                <h3 class="font-semibold text-indigo-900 mb-2">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i>Comment ça marche ?
                </h3>
                <ul class="text-sm text-indigo-800 space-y-1">
                    <li><i class="fas fa-check text-indigo-600 mr-2"></i>Choisissez un titre descriptif pour votre conversation</li>
                    <li><i class="fas fa-check text-indigo-600 mr-2"></i>Sélectionnez l'agent qui correspond à votre besoin</li>
                    <li><i class="fas fa-check text-indigo-600 mr-2"></i>Cliquez sur "Créer la Conversation" pour commencer</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>