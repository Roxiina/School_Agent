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
            background-color: #10a37f;
            color: white;
            border-radius: 18px;
            padding: 12px 16px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .assistant-message {
            background-color: #f7f7f7;
            color: #333;
            border-radius: 18px;
            padding: 12px 16px;
            max-width: 80%;
            word-wrap: break-word;
            border: 1px solid #e5e5e5;
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

        // Wrappers pour les boutons header
        function openStatusMenu() {
            showStatusModal();
        }

        function openInfoMenu() {
            if (!window.currentConvId) {
                alert('Veuillez sélectionner une conversation');
                return;
            }
            showInfoModal();
        }

        function openActionMenu() {
            if (!window.currentConvId) {
                alert('Veuillez sélectionner une conversation');
                return;
            }
            showActionModal(window.currentConvId);
        }

        // ===== GESTION DE L'AFFICHAGE DES CONVERSATIONS =====
        function createMessageElement(message, messageId = null) {
            const div = document.createElement('div');
            
            const isUserMessage = !message.reponse || message.question;
            div.className = 'chat-message ' + (isUserMessage ? 'flex justify-end gap-2' : 'flex justify-start gap-2');
            
            if (isUserMessage) {
                const text = message.question || 'Pas de texte';
                const msgBubble = document.createElement('div');
                msgBubble.className = 'flex gap-2 items-end';
                msgBubble.innerHTML = `
                    <div class="user-message group relative">
                        <p>${escapeHtml(text)}</p>
                        <div class="absolute -bottom-8 right-0 gap-1 hidden group-hover:flex bg-gray-200 rounded p-1 whitespace-nowrap">
                            <button class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600 edit-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600 delete-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                // Ajouter les event listeners
                const editBtn = msgBubble.querySelector('.edit-btn');
                const deleteBtn = msgBubble.querySelector('.delete-btn');
                if (editBtn) editBtn.addEventListener('click', () => editMessage(messageId));
                if (deleteBtn) deleteBtn.addEventListener('click', () => deleteMessage(messageId));
                
                div.appendChild(msgBubble);
            } else {
                const text = message.reponse || 'Pas de réponse';
                div.innerHTML = `
                    <div class="flex gap-3 group">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="assistant-message max-w-2xl relative">
                            <p>${escapeHtml(text).replace(/\n/g, '<br>')}</p>
                            <div class="absolute -bottom-8 left-0 gap-1 hidden group-hover:flex bg-gray-200 rounded p-1 whitespace-nowrap">
                                <button class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600 edit-btn" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600 delete-btn" title="Supprimer">
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
                chatMessagesDiv.innerHTML = '<div class="text-center text-gray-500 py-8">Aucun message dans cette conversation</div>';
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
            if (button) button.disabled = true;

            // Créer et afficher le message utilisateur immédiatement
            const chatDiv = document.getElementById('chatMessages');
            const userMsgEl = createMessageElement({ question: text });
            chatDiv.appendChild(userMsgEl);

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
                if (data.success) {
                    // Ajouter la réponse de l'agent si elle existe
                    if (data.reponse) {
                        const agentMsgEl = createMessageElement({ reponse: data.reponse });
                        chatDiv.appendChild(agentMsgEl);
                    }

                    // Mettre à jour la liste des conversations
                    updateConversationList();

                    // Vider l'input
                    input.value = '';
                    
                    // Scroller vers le bas
                    chatDiv.scrollTop = chatDiv.scrollHeight;
                } else {
                    alert('Erreur lors de l\'envoi du message: ' + (data.error || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur de connexion');
            })
            .finally(() => {
                // Réactiver l'input
                input.disabled = false;
                if (button) button.disabled = false;
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
                window.currentConvId = conversationsData[0].id;
                displayConversation(window.currentConvId);
                // Marquer la première comme active
                const firstItem = document.querySelector('.conversation-item');
                if (firstItem) firstItem.classList.add('active');
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

                <div class="flex items-center gap-2">
                    <button onclick="openStatusMenu()" class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600" title="Statut">
                        <i id="statusIcon" class="fas fa-circle text-lg text-yellow-500"></i>
                    </button>
                    <button onclick="openInfoMenu()" class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600" title="Informations">
                        <i class="fas fa-info-circle text-lg"></i>
                    </button>
                    <button onclick="openActionMenu()" class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600" title="Actions">
                        <i class="fas fa-ellipsis-v text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-white">
                <!-- Les messages s'affichent ici dynamiquement -->
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex gap-3">
                    <input 
                        id="messageInput"
                        type="text" 
                        placeholder="Envoyer un message..." 
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600"
                        onkeypress="if(event.key === 'Enter') sendMessage()"
                    >
                    <button onclick="sendMessage()" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition font-semibold">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>