<?php $pageTitle = 'Conversation - ' . htmlspecialchars($conversation['titre'] ?? 'Détail'); require __DIR__ . '/../templates/header_tailwind.php'; ?>

<style>
/* Styles pour améliorer l'affichage du texte dans les bulles */
.chat-container {
    scroll-behavior: smooth;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.chat-container::-webkit-scrollbar {
    width: 6px;
}

.chat-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.chat-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.chat-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

.chat-message {
    animation: slideIn 0.3s ease-out;
    display: flex;
    width: 100%;
}

.chat-message.user-msg {
    justify-content: flex-end;
}

.chat-message.agent-msg {
    justify-content: flex-start;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* S'assurer que le texte est bien lisible */
.chat-message p {
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: pre-wrap;
    margin: 0;
}

/* Forcer l'affichage horizontal */
.message-wrapper {
    display: flex;
    width: 100%;
    margin-bottom: 1rem;
}

.message-wrapper.user {
    justify-content: flex-end;
}

.message-wrapper.agent {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 70%;
    word-break: break-word;
}

@media (min-width: 640px) {
    .message-bubble {
        max-width: 60%;
    }
}

@media (min-width: 1024px) {
    .message-bubble {
        max-width: 50%;
    }
}
</style>

<div class="mb-8">
    <a href="?page=conversation" class="text-indigo-600 hover:text-indigo-700 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Retour aux conversations
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="flex justify-between items-start mb-6">
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2"><?php echo htmlspecialchars($conversation['titre']); ?></h1>
            <p class="text-gray-600"><?php echo htmlspecialchars($conversation['description'] ?? ''); ?></p>
        </div>
        
        <!-- Boutons d'action en haut à droite -->
        <div class="flex gap-3 ml-6">
            <button 
                onclick="showConversationInfo()" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md"
                title="Informations sur la conversation"
            >
                <i class="fas fa-info-circle"></i>
                <span class="hidden sm:inline">Infos</span>
            </button>
            
            <button 
                onclick="confirmDeleteConversation()" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2 shadow-md"
                title="Supprimer la conversation"
            >
                <i class="fas fa-trash"></i>
                <span class="hidden sm:inline">Supprimer</span>
            </button>
        </div>
    </div>

    <div class="border-t pt-6">
        <h2 class="text-2xl font-bold mb-6">Conversation</h2>
        
        <?php if (!empty($messages)): ?>
            <div class="mb-8 max-h-96 overflow-y-auto bg-gray-50 rounded-lg p-4" id="messagesContainer" style="display: flex; flex-direction: column; gap: 1rem;">
                <?php foreach ($messages as $msg): ?>
                    <!-- Question de l'utilisateur -->
                    <?php if (!empty($msg['question'])): ?>
                        <div style="display: flex; width: 100%; justify-content: flex-end;">
                            <div style="max-width: 70%; margin-left: auto;">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-lg">
                                    <p class="text-sm leading-relaxed" style="margin: 0;"><?php echo nl2br(htmlspecialchars($msg['question'])); ?></p>
                                </div>
                                <div class="text-xs text-gray-500 mt-1 text-right">
                                    <i class="fas fa-user text-xs"></i> Vous
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Réponse de l'agent -->
                    <?php if (!empty($msg['reponse'])): ?>
                        <div style="display: flex; width: 100%; justify-content: flex-start;">
                            <div style="max-width: 70%; display: flex; gap: 12px; align-items: flex-start;">
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <i class="fas fa-robot text-white text-xs"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-4 py-3 shadow-lg">
                                        <p class="text-sm text-gray-800 leading-relaxed" style="margin: 0;"><?php echo nl2br(htmlspecialchars($msg['reponse'])); ?></p>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-robot text-xs"></i> Agent IA
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Aucun message dans cette conversation.</p>
                <p class="text-gray-400 text-sm">Commencez la conversation !</p>
            </div>
        <?php endif; ?>

        <!-- Formulaire pour envoyer un nouveau message -->
        <div class="mt-8 border-t pt-6">
            <form method="POST" action="?page=message&action=create" class="space-y-4" id="messageForm">
                <input type="hidden" name="conversation_id" value="<?php echo $conversation['id_conversation']; ?>">
                
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-dots text-indigo-500"></i> Votre question
                    </label>
                    <div class="relative">
                        <textarea 
                            name="question" 
                            id="question" 
                            rows="3" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none transition-all duration-200"
                            placeholder="Posez votre question à l'agent IA..."
                            required
                        ></textarea>
                        <div class="absolute right-4 bottom-3 text-gray-400">
                            <i class="fas fa-keyboard text-sm"></i>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <div class="text-xs text-gray-500">
                        Appuyez sur <kbd class="px-2 py-1 bg-gray-100 rounded border text-gray-700">Ctrl + Entrée</kbd> pour envoyer
                    </div>
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-full hover:shadow-lg transition-all duration-200 flex items-center gap-2"
                        id="sendButton"
                    >
                        <i class="fas fa-paper-plane"></i>
                        <span class="hidden sm:inline">Envoyer</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Les boutons d'action en bas ont été retirés car ils sont désormais disponibles en haut à droite -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('messagesContainer');
    const messageForm = document.getElementById('messageForm');
    const questionInput = document.getElementById('question');
    const sendButton = document.getElementById('sendButton');
    
    // Auto-scroll vers le bas au chargement
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    // Raccourci clavier Ctrl+Entrée pour envoyer
    questionInput.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            messageForm.submit();
        }
    });
    
    // Auto-resize du textarea
    questionInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 150) + 'px';
    });
    
    // Animation au focus
    questionInput.addEventListener('focus', function() {
        this.parentElement.classList.add('ring-2', 'ring-indigo-200');
    });
    
    questionInput.addEventListener('blur', function() {
        this.parentElement.classList.remove('ring-2', 'ring-indigo-200');
    });
    
    // Effet de loading sur le bouton d'envoi
    messageForm.addEventListener('submit', function() {
        sendButton.disabled = true;
        sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span class="hidden sm:inline ml-2">Envoi...</span>';
        
        // Simuler l'ajout d'un message utilisateur
        if (questionInput.value.trim()) {
            const userMessage = document.createElement('div');
            userMessage.style.display = 'flex';
            userMessage.style.width = '100%';
            userMessage.style.justifyContent = 'flex-end';
            userMessage.innerHTML = `
                <div style="max-width: 70%; margin-left: auto;">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-lg">
                        <p class="text-sm leading-relaxed" style="margin: 0;">${questionInput.value.replace(/\n/g, '<br>')}</p>
                    </div>
                    <div class="text-xs text-gray-500 mt-1 text-right">
                        <i class="fas fa-user text-xs"></i> Vous
                    </div>
                </div>
            `;
            
            if (messagesContainer) {
                messagesContainer.appendChild(userMessage);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Ajouter un indicateur de chargement pour la réponse
            const loadingMessage = document.createElement('div');
            loadingMessage.style.display = 'flex';
            loadingMessage.style.width = '100%';
            loadingMessage.style.justifyContent = 'flex-start';
            loadingMessage.id = 'loading-indicator';
            loadingMessage.innerHTML = `
                <div style="max-width: 70%; display: flex; gap: 12px; align-items: flex-start;">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                        <i class="fas fa-robot text-white text-xs"></i>
                    </div>
                    <div style="flex: 1;">
                        <div class="bg-gray-100 border border-gray-200 rounded-2xl rounded-bl-md px-4 py-3 shadow-lg">
                            <div class="flex items-center gap-2">
                                <div class="flex gap-1">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                </div>
                                <span class="text-sm text-gray-600">L'agent réfléchit...</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (messagesContainer) {
                messagesContainer.appendChild(loadingMessage);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }
    });
    
    // Fonctions pour les boutons d'action - Définies globalement
    window.showConversationInfo = function() {
        const modal = document.getElementById('infoModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            console.error('Modal infoModal non trouvé');
        }
    };

    window.closeInfoModal = function() {
        const modal = document.getElementById('infoModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    window.confirmDeleteConversation = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            console.error('Modal deleteModal non trouvé');
        }
    };

    window.closeDeleteModal = function() {
        const modal = document.getElementById('deleteModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    window.deleteConversation = function() {
        window.location.href = '?page=conversation&action=delete&id=<?php echo $conversation['id_conversation']; ?>';
    };
    
    // Fermer les modals en cliquant à l'extérieur
    document.addEventListener('click', function(e) {
        const infoModal = document.getElementById('infoModal');
        const deleteModal = document.getElementById('deleteModal');
        
        if (e.target === infoModal) {
            closeInfoModal();
        }
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });
    
    // Fermer les modals avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeInfoModal();
            closeDeleteModal();
        }
    });
    
    // Animation d'apparition des messages existants
    const messages = document.querySelectorAll('.chat-message');
    messages.forEach((message, index) => {
        message.style.opacity = '0';
        message.style.transform = 'translateY(20px)';
        setTimeout(() => {
            message.style.transition = 'all 0.4s ease';
            message.style.opacity = '1';
            message.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>

<!-- Modal d'informations -->
<div id="infoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 m-4 max-w-md w-full shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Informations sur la conversation
            </h3>
            <button onclick="closeInfoModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Titre :</span>
                <span class="font-medium"><?php echo htmlspecialchars($conversation['titre']); ?></span>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Agent :</span>
                <span class="font-medium flex items-center gap-2">
                    <i class="fas fa-robot text-indigo-500"></i>
                    <?php echo htmlspecialchars($conversation['agent_nom'] ?? 'Agent IA'); ?>
                </span>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Messages :</span>
                <span class="font-medium"><?php echo count($messages ?? []); ?> message(s)</span>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Créée le :</span>
                <span class="font-medium"><?php echo date('d/m/Y à H:i', strtotime($conversation['date_creation'] ?? 'now')); ?></span>
            </div>
            
            <?php if (!empty($conversation['description'])): ?>
            <div class="pt-3 border-t">
                <span class="text-gray-600">Description :</span>
                <p class="text-sm text-gray-800 mt-1"><?php echo nl2br(htmlspecialchars($conversation['description'])); ?></p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="flex justify-end mt-6">
            <button 
                onclick="closeInfoModal()" 
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors"
            >
                Fermer
            </button>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 m-4 max-w-md w-full shadow-xl">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-3"></i>
            <h3 class="text-lg font-bold text-gray-900">Supprimer la conversation</h3>
        </div>
        
        <p class="text-gray-600 mb-6">
            Êtes-vous sûr de vouloir supprimer la conversation 
            <strong>"<?php echo htmlspecialchars($conversation['titre']); ?>"</strong> ?
            <br><br>
            <span class="text-red-600 text-sm">
                ⚠️ Cette action est irréversible et supprimera tous les messages associés.
            </span>
        </p>
        
        <div class="flex justify-end gap-3">
            <button 
                onclick="closeDeleteModal()" 
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors"
            >
                Annuler
            </button>
            <button 
                onclick="deleteConversation()" 
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors"
            >
                <i class="fas fa-trash mr-2"></i>
                Supprimer
            </button>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer_tailwind.php'; ?>