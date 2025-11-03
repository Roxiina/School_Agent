<?php
// Démarrer la session
\SchoolAgent\Config\Authenticator::startSession();

// Vérifier que l'utilisateur est connecté
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
    <title>Conversations - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #ffffff;
        }
        .sidebar {
            background-color: #f7f7f7;
            border-right: 1px solid #e5e5e5;
        }
        .chat-message {
            animation: slideIn 0.3s ease-out;
        }
        #chatMessages {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
            scroll-behavior: smooth;
            background-color: #f9fafb;
        }
        /* Amélioration du scroll bar */
        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }
        #chatMessages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        #chatMessages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
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
        .user-message {
            /* Styles remplacés par styles inline pour une meilleure compatibilité */
        }
        .assistant-message {
            /* Styles remplacés par styles inline pour une meilleure compatibilité */
        }
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        /* Animation pour les nouvelles bulles */
        .chat-message {
            animation: bubbleSlideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        @keyframes bubbleSlideIn {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.8);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        /* Amélioration des boutons d'action */
        .chat-message .group:hover .group-hover\\:flex {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .conversation-item {
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
            border: 1px solid transparent;
        }
        .conversation-item:hover {
            background-color: #e5e5e5;
        }
        .conversation-item.active {
            background-color: #d3d3d3;
            border: 1px solid #bbb;
        }
        input[type="text"]::placeholder {
            color: #999;
        }
    </style>
    <script>
        // ===== VARIABLES GLOBALES =====
        window.currentConvId = null;
        window.currentConversationStatus = 'en_cours';
        
        // ===== DONNÉES DES CONVERSATIONS DEPUIS PHP =====
        let conversationsData = <?php echo json_encode(array_map(function($conv) {
            return [
                'id' => $conv['id'],
                'name' => $conv['agent_nom'],
                'titre' => $conv['titre'],
                'messages' => $conv['messages'] ?? []
            ];
        }, $conversationsData)); ?>;

        // ===== FONCTIONS MODALS - DÉFINIES IMMÉDIATEMENT =====
        function showStatusModal() {
            const modal = document.getElementById('statusModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                updateStatusCheckmarks();
            }
        }

        function closeStatusModal() {
            const modal = document.getElementById('statusModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function updateStatusCheckmarks() {
            ['check-en_cours', 'check-terminee', 'check-archivee'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.innerHTML = '<i class="fas fa-check hidden"></i>';
            });
            const checkEl = document.getElementById('check-' + window.currentConversationStatus);
            if (checkEl) checkEl.innerHTML = '<i class="fas fa-check"></i>';
        }

        function setConversationStatus(status) {
            window.currentConversationStatus = status;
            updateStatusCheckmarks();
            
            const statusIcon = document.getElementById('statusIcon');
            const statuses = {
                'en_cours': { icon: 'fa-circle', color: 'text-yellow-500' },
                'terminee': { icon: 'fa-check-circle', color: 'text-green-500' },
                'archivee': { icon: 'fa-archive', color: 'text-gray-500' }
            };
            
            if (statusIcon && statuses[status]) {
                statusIcon.className = `fas ${statuses[status].icon} text-lg ${statuses[status].color}`;
            }
            
            closeStatusModal();
        }

        function showActionModal(convId) {
            const modal = document.getElementById('actionModal');
            if (modal) {
                modal.setAttribute('data-conv-id', convId);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeActionModal() {
            const modal = document.getElementById('actionModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function showInfoModal() {
            if (!window.currentConvId) return;
            const conv = conversationsData.find(c => c.id == window.currentConvId);
            if (!conv) return;
            
            document.getElementById('infoAgent').textContent = conv.name;
            document.getElementById('infoTitre').textContent = conv.titre;
            
            const msgCount = conv.messages ? conv.messages.length : 0;
            document.getElementById('infoMessages').textContent = msgCount + (msgCount > 1 ? ' messages' : ' message');
            
            const modal = document.getElementById('infoModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeInfoModal() {
            const modal = document.getElementById('infoModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // ===== FONCTIONS DE NOTIFICATION =====
        function showSuccessMessage(message) {
            showNotification(message, 'success');
        }
        
        function showErrorMessage(message) {
            showNotification(message, 'error');
        }
        
        function showNotification(message, type = 'info') {
            // Supprimer toute notification existante
            const existingNotification = document.getElementById('notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Créer la notification
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
            
            // Couleurs selon le type
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
            
            // Ajouter au body
            document.body.appendChild(notification);
            
            // Animation d'entrée
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Auto-suppression après 4 secondes
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        // ===== FONCTIONS POUR LES NOUVEAUX BOUTONS =====
        window.showConversationInfo = function() {
            if (!window.currentConvId) {
                showErrorMessage('Veuillez sélectionner une conversation');
                return;
            }
            const modal = document.getElementById('infoModal');
            if (modal) {
                // Mettre à jour les informations dans le modal
                const currentConv = conversationsData.find(c => c.id == window.currentConvId);
                if (currentConv) {
                    document.getElementById('modalConvTitle').textContent = currentConv.titre || 'Sans titre';
                    document.getElementById('modalAgentName').textContent = currentConv.name || 'Agent inconnu';
                    document.getElementById('modalMessageCount').textContent = (currentConv.messages?.length || 0) + ' message(s)';
                }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                console.log('Modal info ouvert');
            } else {
                console.error('Modal infoModal non trouvé');
            }
        }

        window.closeInfoModal = function() {
            const modal = document.getElementById('infoModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                console.log('Modal info fermé');
            }
        }

        window.confirmDeleteConversation = function() {
            if (!window.currentConvId) {
                showErrorMessage('Veuillez sélectionner une conversation');
                return;
            }
            const modal = document.getElementById('deleteModal');
            if (modal) {
                // Mettre à jour le titre dans le modal de suppression
                const currentConv = conversationsData.find(c => c.id == window.currentConvId);
                if (currentConv) {
                    document.getElementById('deleteConvTitle').textContent = currentConv.titre || 'Sans titre';
                }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                console.log('Modal suppression ouvert');
            } else {
                console.error('Modal deleteModal non trouvé');
            }
        }

        window.closeDeleteModal = function() {
            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                console.log('Modal suppression fermé');
            }
        }

        window.deleteConversation = function() {
            if (!window.currentConvId) {
                showErrorMessage('Aucune conversation sélectionnée');
                return;
            }
            
            console.log('Suppression de la conversation ID:', window.currentConvId);
            
            // Désactiver le bouton pour éviter les doubles clics
            const deleteBtn = document.querySelector('#deleteModal button[onclick="deleteConversation()"]');
            if (deleteBtn) {
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Suppression...';
            }
            
            // Faire l'appel AJAX pour supprimer la conversation
            fetch(`?page=conversation&action=delete&id=${window.currentConvId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Réponse HTTP status:', response.status);
                console.log('Réponse headers:', response.headers);
                return response.text(); // D'abord récupérer en text pour voir le contenu
            })
            .then(text => {
                console.log('Réponse brute du serveur:', text);
                try {
                    const data = JSON.parse(text);
                    console.log('Données JSON parsées:', data);
                    
                    if (data.success) {
                        // Fermer le modal
                        closeDeleteModal();
                        
                        // Supprimer la conversation de la liste
                        const convElement = document.querySelector(`.conversation-item[data-id="${window.currentConvId}"]`);
                        if (convElement) {
                            convElement.remove();
                        }
                        
                        // Supprimer des données locales
                        conversationsData = conversationsData.filter(c => c.id != window.currentConvId);
                        
                        // Réinitialiser la sélection
                        window.currentConvId = null;
                        
                        // Vider la zone de chat
                        const chatDiv = document.getElementById('chatMessages');
                        if (chatDiv) {
                            chatDiv.innerHTML = '<div class="text-center text-gray-500 p-8">Sélectionnez une conversation pour commencer</div>';
                        }
                        
                        // Mettre à jour le header
                        document.getElementById('agentName').textContent = 'Agent Scolaire';
                        
                        // Afficher un message de succès intégré dans la page
                        showSuccessMessage('Conversation supprimée avec succès !');
                        
                        // Si plus aucune conversation, afficher le message approprié
                        if (conversationsData.length === 0) {
                            const sidebar = document.querySelector('.sidebar .space-y-2');
                            if (sidebar) {
                                sidebar.innerHTML = '<div class="p-4 text-center text-gray-500"><p>Aucune conversation</p></div>';
                            }
                        } else {
                            // Sélectionner automatiquement la première conversation restante
                            const firstConv = conversationsData[0];
                            if (firstConv) {
                                selectConversation(firstConv.id);
                            }
                        }
                    } else {
                        showErrorMessage('Erreur lors de la suppression de la conversation');
                        console.error('Erreur suppression (success=false):', data);
                    }
                } catch (parseError) {
                    console.error('Erreur de parsing JSON:', parseError);
                    console.error('Contenu qui n\'est pas du JSON valide:', text);
                    showErrorMessage('Erreur de format de réponse du serveur');
                }
            })
            .catch(error => {
                console.error('Erreur lors de la suppression:', error);
                showErrorMessage('Erreur de connexion lors de la suppression');
            })
            .finally(() => {
                // Réactiver le bouton
                if (deleteBtn) {
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = '<i class="fas fa-trash mr-2"></i>Supprimer';
                }
            });
        }

        // ===== GESTION DE L'AFFICHAGE DES CONVERSATIONS =====
        function createMessageElement(message, messageId = null) {
            const div = document.createElement('div');
            
            const isUserMessage = !message.reponse || message.question;
            
            if (isUserMessage) {
                const text = message.question || 'Pas de texte';
                div.style.display = 'flex';
                div.style.width = '100%';
                div.style.justifyContent = 'flex-end';
                div.innerHTML = `
                    <div style="max-width: 70%; margin-left: auto;" class="group">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-lg">
                            <p class="text-sm" style="margin: 0;">${escapeHtml(text)}</p>
                        </div>
                        <div class="text-xs text-gray-500 mt-1 text-right">
                            <i class="fas fa-user text-xs"></i> Vous
                        </div>
                        <div class="absolute -bottom-10 right-0 gap-1 hidden group-hover:flex rounded-lg p-2 whitespace-nowrap">
                            <button class="px-3 py-1 text-xs bg-indigo-500 text-white rounded-full hover:bg-indigo-600 edit-btn transition-all duration-200" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="px-3 py-1 text-xs bg-red-500 text-white rounded-full hover:bg-red-600 delete-btn transition-all duration-200" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                // Ajouter les event listeners
                const editBtn = div.querySelector('.edit-btn');
                const deleteBtn = div.querySelector('.delete-btn');
                if (editBtn) editBtn.addEventListener('click', () => editMessage(messageId));
                if (deleteBtn) deleteBtn.addEventListener('click', () => deleteMessage(messageId));
                
            } else {
                const text = message.reponse || 'Pas de réponse';
                div.style.display = 'flex';
                div.style.width = '100%';
                div.style.justifyContent = 'flex-start';
                div.innerHTML = `
                    <div style="max-width: 70%; display: flex; gap: 12px; align-items: flex-start;" class="group">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div style="flex: 1; position: relative;">
                            <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-4 py-3 shadow-lg">
                                <p class="text-sm text-gray-800" style="margin: 0;">${escapeHtml(text).replace(/\n/g, '<br>')}</p>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-robot text-xs"></i> Agent IA
                            </div>
                            <div class="absolute -bottom-10 left-0 gap-1 hidden group-hover:flex rounded-lg p-2 whitespace-nowrap">
                                <button class="px-3 py-1 text-xs bg-indigo-500 text-white rounded-full hover:bg-indigo-600 edit-btn transition-all duration-200" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="px-3 py-1 text-xs bg-red-500 text-white rounded-full hover:bg-red-600 delete-btn transition-all duration-200" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                // Ajouter les event listeners
                const editBtn = div.querySelector('.edit-btn');
                const deleteBtn = div.querySelector('.delete-btn');
                if (editBtn) editBtn.addEventListener('click', () => editMessage(messageId));
                if (deleteBtn) deleteBtn.addEventListener('click', () => deleteMessage(messageId));
            }
            
            return div;
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function displayConversation(convId) {
            const data = conversationsData.find(c => c.id == convId);
            if (!data) return;

            const chatMessagesDiv = document.getElementById('chatMessages');
            const agentNameEl = document.getElementById('agentName');

            // Vider les messages précédents
            chatMessagesDiv.innerHTML = '';

            // Mettre à jour le header
            agentNameEl.textContent = data.name;

            // Afficher les messages
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach((msg, index) => {
                    const msgId = msg.id_message || msg.id || index;
                    const msgEl = createMessageElement(msg, msgId);
                    chatMessagesDiv.appendChild(msgEl);
                });
            } else {
                chatMessagesDiv.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full text-center py-12">
                        <i class="fas fa-comments text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Aucun message dans cette conversation</p>
                        <p class="text-gray-400 text-sm">Commencez à discuter !</p>
                    </div>
                `;
            }

            // Scroller vers le bas
            setTimeout(() => {
                chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight;
            }, 0);
        }

        // ===== ÉDITION ET SUPPRESSION DE MESSAGES =====
        function editMessage(messageId) {
            const newText = prompt('Modifiez le message :');
            if (newText === null || newText.trim() === '') return;

            fetch('?page=message/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    message_id: messageId,
                    question: newText,
                    conversation_id: window.currentConvId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le message dans le tableau conversationsData
                    let found = false;
                    for (let conv of conversationsData) {
                        for (let msg of conv.messages || []) {
                            if ((msg.id_message || msg.id) == messageId) {
                                msg.question = newText;
                                found = true;
                                break;
                            }
                        }
                        if (found) break;
                    }
                    
                    // Rafraîchir l'affichage
                    if (window.currentConvId) {
                        displayConversation(window.currentConvId);
                    }
                } else {
                    alert('Erreur lors de la modification: ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur de connexion');
            });
        }

        function deleteMessage(messageId) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) return;

            fetch('?page=message/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    message_id: messageId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Supprimer le message du tableau conversationsData
                    for (let conv of conversationsData) {
                        conv.messages = (conv.messages || []).filter(msg => 
                            (msg.id_message || msg.id) != messageId
                        );
                    }
                    
                    // Rafraîchir l'affichage
                    if (window.currentConvId) {
                        displayConversation(window.currentConvId);
                    }
                } else {
                    alert('Erreur lors de la suppression: ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur de connexion');
            });
        }

        // ===== ENVOI DE MESSAGE =====
        function sendMessage() {
            const input = document.getElementById('messageInput');
            const button = document.querySelector('button[onclick="sendMessage()"]');
            const text = input.value.trim();

            if (!text) {
                alert('Veuillez entrer un message');
                return;
            }

            if (!window.currentConvId) {
                alert('Veuillez sélectionner une conversation');
                return;
            }

            // Désactiver l'input pendant l'envoi
            input.disabled = true;
            if (button) {
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            // Créer et afficher le message utilisateur immédiatement
            const chatDiv = document.getElementById('chatMessages');
            const userMsgEl = createMessageElement({ question: text });
            chatDiv.appendChild(userMsgEl);

            // Créer un indicateur de chargement pour la réponse
            const loadingEl = document.createElement('div');
            loadingEl.style.display = 'flex';
            loadingEl.style.width = '100%';
            loadingEl.style.justifyContent = 'flex-start';
            loadingEl.innerHTML = `
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
            chatDiv.appendChild(loadingEl);

            // Scroll vers le bas
            chatDiv.scrollTop = chatDiv.scrollHeight;

            // Effacer l'input
            input.value = '';

            // Envoyer le message au serveur
            fetch('?page=message/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    conversation_id: window.currentConvId,
                    question: text
                })
            })
            .then(response => response.json())
            .then(data => {
                // Supprimer l'indicateur de chargement
                loadingEl.remove();
                
                if (data.success) {
                    // Ajouter la réponse de l'agent si elle existe
                    if (data.reponse) {
                        const agentMsgEl = createMessageElement({ reponse: data.reponse });
                        chatDiv.appendChild(agentMsgEl);
                    }

                    // Mettre à jour la liste des conversations
                    updateConversationList();
                    
                    // Scroller vers le bas
                    chatDiv.scrollTop = chatDiv.scrollHeight;
                } else {
                    alert('Erreur lors de l\'envoi du message: ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                // Supprimer l'indicateur de chargement en cas d'erreur
                loadingEl.remove();
                alert('Erreur de connexion');
            })
            .finally(() => {
                // Réactiver l'input
                input.disabled = false;
                if (button) {
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-paper-plane"></i>';
                }
                input.focus();
            });
        }

        function updateConversationList() {
            // Rafraîchir la liste des conversations avec les derniers messages
            fetch('?page=conversation', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Parser le HTML et extraire les conversations
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                // On peut laisser la liste se mettre à jour au prochain rechargement
            })
            .catch(error => console.error('Erreur lors de la mise à jour:', error));
        }

        // ===== FONCTION POUR SÉLECTIONNER UNE CONVERSATION =====
        function selectConversation(convId) {
            // Retirer la classe active de tous les items
            document.querySelectorAll('.conversation-item').forEach(i => i.classList.remove('active'));
            
            // Trouver et activer l'item correspondant
            const targetItem = document.querySelector(`.conversation-item[data-id="${convId}"]`);
            if (targetItem) {
                targetItem.classList.add('active');
            }

            // Mettre à jour la conversation actuelle
            window.currentConvId = convId;

            // Afficher la conversation
            displayConversation(convId);
        }

        // ===== INITIALISATION AU CHARGEMENT =====
        document.addEventListener('DOMContentLoaded', function() {
            // Ajouter click listeners sur les conversations
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.addEventListener('click', function() {
                    // Retirer la classe active de tous les items
                    document.querySelectorAll('.conversation-item').forEach(i => i.classList.remove('active'));
                    
                    // Ajouter la classe active à l'item cliqué
                    this.classList.add('active');

                    // Récupérer l'ID de la conversation
                    const convId = parseInt(this.getAttribute('data-id'));
                    window.currentConvId = convId;

                    // Afficher la conversation
                    displayConversation(convId);
                });
            });
            
            // Initialiser avec la première conversation si elle existe
            if (conversationsData.length > 0) {
                selectConversation(conversationsData[0].id);
            }
        });
    </script>
</head>
<body class="bg-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 flex flex-col border-r border-gray-200">
            <!-- Header Sidebar -->
            <div class="p-4 border-b border-gray-200">
                <button onclick="window.location.href='?page=conversation&action=create'" class="w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition font-semibold text-gray-700">
                    <i class="fas fa-plus"></i> Nouvelle conversation
                </button>
            </div>

            <!-- Conversations List -->
            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                <?php 
                if (empty($conversationsData)): 
                ?>
                    <div class="p-4 text-center text-gray-500">
                        <p>Aucune conversation</p>
                    </div>
                <?php 
                else:
                    foreach ($conversationsData as $index => $conv): 
                        $isActive = $index === 0 ? 'active' : '';
                        $lastMessage = end($conv['messages']);
                        $preview = $lastMessage ? substr($lastMessage['reponse'] ?? $lastMessage['question'], 0, 50) . '...' : 'Pas de message';
                ?>
                    <div class="conversation-item <?php echo $isActive; ?>" data-id="<?php echo $conv['id']; ?>">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-robot text-white text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate"><?php echo htmlspecialchars($conv['titre']); ?></p>
                                <p class="text-xs text-gray-600 mt-1 truncate"><?php echo htmlspecialchars($preview); ?></p>
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach;
                endif;
                ?>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-200">
                <a href="?page=home" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-sm font-semibold">Accueil</span>
                </a>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white">
            <!-- Chat Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-robot text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 id="agentName" class="text-lg font-semibold text-gray-900">Agent Scolaire</h2>
                        <p class="text-sm text-gray-500">En ligne</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button 
                        onclick="showConversationInfo()" 
                        class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600 flex items-center gap-2"
                        title="Informations sur la conversation"
                    >
                        <i class="fas fa-info-circle text-lg"></i>
                        <span class="hidden sm:inline text-sm font-medium">Infos</span>
                    </button>
                    
                    <button 
                        onclick="confirmDeleteConversation()" 
                        class="p-2 hover:bg-red-50 rounded-lg transition text-red-600 flex items-center gap-2"
                        title="Supprimer la conversation"
                    >
                        <i class="fas fa-trash text-lg"></i>
                        <span class="hidden sm:inline text-sm font-medium">Supprimer</span>
                    </button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessages" class="flex-1 overflow-y-auto p-6 bg-gray-50" style="display: flex; flex-direction: column; gap: 1rem;">
                <!-- Les messages s'affichent ici dynamiquement -->
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex gap-3 items-end">
                    <div class="flex-1 relative">
                        <input 
                            id="messageInput"
                            type="text" 
                            placeholder="Tapez votre message..." 
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 resize-none"
                            onkeypress="if(event.key === 'Enter') sendMessage()"
                        >
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <i class="fas fa-keyboard text-sm"></i>
                        </div>
                    </div>
                    <button 
                        onclick="sendMessage()" 
                        class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-3 rounded-full hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center justify-center min-w-[3rem]"
                        title="Envoyer le message"
                    >
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
                <div class="text-xs text-gray-500 mt-2 text-center">
                    Appuyez sur <kbd class="px-2 py-1 bg-gray-100 rounded border">Entrée</kbd> pour envoyer
                </div>
            </div>
        </div>
    </div>

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
                    <span id="modalConvTitle" class="font-medium">--</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Agent :</span>
                    <span id="modalAgentName" class="font-medium flex items-center gap-2">
                        <i class="fas fa-robot text-indigo-500"></i>
                        --
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Messages :</span>
                    <span id="modalMessageCount" class="font-medium">-- message(s)</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Créée le :</span>
                    <span class="font-medium">03/11/2025 à 14:30</span>
                </div>
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
                <strong id="deleteConvTitle">"--"</strong> ?
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

    <script>
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
    </script>

</body>
</html>