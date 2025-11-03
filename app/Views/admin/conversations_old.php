<?php
// Cette page sera incluse dans dashboard.php quand section=conversations
?>

<div class="animate-slide-up">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Gestion des conversations</h1>
        <p class="text-gray-600">Surveiller et modérer les conversations des utilisateurs</p>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex gap-4 items-center">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchConversations" placeholder="Rechercher une conversation..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <select id="filterAgent" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">Tous les agents</option>
                    <option value="Agent Mathéo">Agent Mathéo</option>
                    <option value="Agent Histoire">Agent Histoire</option>
                    <option value="Agent Scolaire">Agent Scolaire</option>
                </select>
            </div>
            
            <div class="flex gap-3">
                <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold flex items-center gap-2">
                    <i class="fas fa-download"></i> Exporter
                </button>
                <button class="bg-gradient-to-r from-purple-600 to-violet-600 text-white px-6 py-2 rounded-lg hover:shadow-lg transition font-semibold flex items-center gap-2">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </button>
            </div>
        </div>
    </div>

    <!-- Conversations Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-comments text-green-600"></i>
                Liste des conversations
                <span class="text-sm font-normal text-gray-500 ml-2">
                    (<?php echo count($conversations ?? []); ?> conversations)
                </span>
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-4 font-semibold text-gray-900">Conversation</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Utilisateur</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Agent</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Messages</th>
                        <th class="text-left p-4 font-semibold text-gray-900">Date</th>
                        <th class="text-center p-4 font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($conversations)): ?>
                        <?php foreach ($conversations as $conversation): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-comment text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                <?php echo htmlspecialchars($conversation['titre']); ?>
                                            </p>
                                            <p class="text-sm text-gray-500">ID: <?php echo $conversation['id_conversation']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div>
                                        <p class="font-medium text-gray-900">
                                            <?php echo htmlspecialchars($conversation['user_nom'] . ' ' . $conversation['user_prenom']); ?>
                                        </p>
                                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($conversation['user_email']); ?></p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <?php if (!empty($conversation['agent_avatar'])): ?>
                                            <img src="images/<?php echo htmlspecialchars($conversation['agent_avatar']); ?>" 
                                                 alt="Avatar" class="w-6 h-6 rounded-full">
                                        <?php endif; ?>
                                        <span class="text-gray-700"><?php echo htmlspecialchars($conversation['agent_nom']); ?></span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <?php echo $conversation['message_count']; ?> messages
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="text-gray-700">
                                        <?php echo date('d/m/Y H:i', strtotime($conversation['date_creation'])); ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Button -->
                                        <a href="?page=conversation&action=show&id=<?php echo $conversation['id_conversation']; ?>" 
                                           class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center hover:bg-indigo-200 transition-colors"
                                           title="Voir la conversation">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        
                                        <!-- Edit Button -->
                                        <button class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center hover:bg-yellow-200 transition-colors"
                                                title="Modérer la conversation">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        
                                        <!-- Delete Button -->
                                        <form method="POST" action="?page=admin/delete-conversation" class="inline" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation et tous ses messages ?')">
                                            <input type="hidden" name="conversation_id" value="<?php echo $conversation['id_conversation']; ?>">
                                            <button type="submit" 
                                                    class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition-colors"
                                                    title="Supprimer la conversation">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-4">
                                    <i class="fas fa-comments text-4xl text-gray-300"></i>
                                    <p class="text-lg">Aucune conversation trouvée</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Conversation Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-comments text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo count($conversations ?? []); ?>
                    </p>
                    <p class="text-gray-600">Total conversations</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-message text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php echo array_sum(array_column($conversations ?? [], 'message_count')); ?>
                    </p>
                    <p class="text-gray-600">Total messages</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-day text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php 
                        $today = date('Y-m-d');
                        $todayCount = 0;
                        foreach ($conversations ?? [] as $conv) {
                            if (date('Y-m-d', strtotime($conv['date_creation'])) === $today) {
                                $todayCount++;
                            }
                        }
                        echo $todayCount;
                        ?>
                    </p>
                    <p class="text-gray-600">Aujourd'hui</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php 
                        $avgMessages = !empty($conversations) ? 
                            round(array_sum(array_column($conversations, 'message_count')) / count($conversations), 1) : 0;
                        echo $avgMessages;
                        ?>
                    </p>
                    <p class="text-gray-600">Moy. messages</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchConversations')?.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Agent filter
document.getElementById('filterAgent')?.addEventListener('change', function() {
    const selectedAgent = this.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        if (!selectedAgent) {
            row.style.display = '';
        } else {
            const agentCell = row.querySelector('td:nth-child(3)');
            const hasAgent = agentCell && agentCell.textContent.includes(selectedAgent);
            row.style.display = hasAgent ? '' : 'none';
        }
    });
});
</script>