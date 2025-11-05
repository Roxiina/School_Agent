<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/front/home.css">
    <link rel="stylesheet" href="/css/front/conversation.css">
    
    <style>
        /* Modal Agent Selection */
        .agent-selection-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease-out;
        }

        .agent-selection-modal.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .modal-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: #1f2937;
            margin: 0 0 10px 0;
        }

        .modal-header p {
            font-size: 15px;
            color: #6b7280;
            margin: 0;
        }

        .modal-history-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
        }

        .modal-history-item {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .modal-history-item:last-child {
            border-bottom: none;
        }

        .modal-history-item:hover {
            background: #f3f4f6;
        }

        .modal-history-item.selected {
            background: #eff6ff;
            border-left: 4px solid #10b981;
            padding-left: 12px;
        }

        .modal-history-icon {
            font-size: 20px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .modal-history-info {
            flex: 1;
            min-width: 0;
        }

        .modal-history-title {
            font-size: 15px;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 4px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-history-agent {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }

        .modal-empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #9ca3af;
        }

        .modal-empty-state-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .modal-empty-state p {
            margin: 0;
            font-size: 14px;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .modal-btn {
            padding: 12px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .modal-btn-cancel:hover {
            background: #e5e7eb;
        }

        .modal-btn-continue {
            background: #10b981;
            color: white;
            opacity: 0.5;
            cursor: not-allowed;
        }

        .modal-btn-continue:not(:disabled):hover {
            background: #059669;
            opacity: 1;
        }

        .modal-btn-continue.enabled {
            opacity: 1;
            cursor: pointer;
        }

        .modal-agent-quick-btn {
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-agent-quick-btn:hover {
            border-color: #10b981;
            background: #f0fdf4;
            color: #10b981;
        }

        .modal-agent-quick-btn.selected {
            border-color: #10b981;
            background: #ecfdf5;
            color: #059669;
            font-weight: 600;
        }

        /* Conversation List Styles */
        .conversation-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 12px;
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }

        .conversation-item {
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            text-decoration: none;
            color: inherit;
            background: white;
            border: 1px solid #e5e7eb;
        }

        .conversation-item:hover {
            background: #f9fafb;
            border-color: #10b981;
        }

        .conversation-item.active {
            background: #ecfdf5;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .conversation-item-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .conversation-item-info {
            flex: 1;
            min-width: 0;
        }

        .conversation-item-title {
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conversation-item-date {
            font-size: 12px;
            color: #9ca3af;
            margin: 4px 0 0 0;
        }

        @media (max-width: 640px) {
            .modal-content {
                padding: 30px 20px;
            }

            .modal-header h2 {
                font-size: 22px;
            }

            .modal-agents-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php 
        // Fonction pour obtenir l'icône correspondante à chaque agent
        // Définie au début pour être accessible partout dans la vue
        $getAgentIcon = function($agentName, $avatar) {
            $name = strtolower($agentName);
            
            // Mapping basé sur le nom ou l'avatar
            if (strpos($name, 'math') !== false || strpos($avatar, 'math') !== false) {
                return 'fas fa-calculator';
            } elseif (strpos($name, 'histoire') !== false || strpos($avatar, 'hist') !== false) {
                return 'fas fa-book-open';
            } elseif (strpos($name, 'scolaire') !== false || strpos($avatar, 'school') !== false) {
                return 'fas fa-graduation-cap';
            } elseif (strpos($name, 'français') !== false || strpos($name, 'français') !== false) {
                return 'fas fa-pen-fancy';
            } elseif (strpos($name, 'science') !== false) {
                return 'fas fa-flask';
            } elseif (strpos($name, 'english') !== false || strpos($name, 'anglais') !== false) {
                return 'fas fa-flag';
            } else {
                return 'fas fa-robot';
            }
        };
    ?>
    
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            
            <ul class="nav-menu">
                <li><a href="/home" class="nav-link">Accueil</a></li>
                <li><a href="/agents" class="nav-link">Nos Agents</a></li>
                <?php if (isset($isLogged) && $isLogged && isset($user['role']) && $user['role'] === 'etudiant'): ?>
                    <li><a href="/conversation" class="nav-link active" style="color: #10b981; font-weight: 600;">💬 Discuter</a></li>
                <?php endif; ?>
                <?php if (isset($isLogged) && $isLogged): ?>
                    <li><span class="nav-welcome" style="color: #10b981; font-weight: 500; padding: 8px 16px;">
                        Bonjour <?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?> ! 👋
                    </span></li>
                    <li><a href="/logout" class="btn btn-danger" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Modal Agent Selection -->
    <div class="agent-selection-modal <?= !isset($agent) || !$agent ? 'active' : '' ?>" id="agentSelectionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>💬 Vos Conversations</h2>
                <p>Choisissez une conversation précédente ou démarrez une nouvelle</p>
            </div>

            <div class="modal-history-container" id="modalHistoryContainer">
                <?php if (!empty($conversationHistory) ?? false): ?>
                    <?php foreach ($conversationHistory as $conv): ?>
                        <div class="modal-history-item" data-conv-id="<?= $conv['id_conversation'] ?>" data-agent-id="<?= $conv['id_agent'] ?>">
                            <div class="modal-history-icon">💬</div>
                            <div class="modal-history-info">
                                <p class="modal-history-title"><?= htmlspecialchars(substr($conv['titre'], 0, 50)) ?></p>
                                <p class="modal-history-agent">
                                    Agent: <strong><?= htmlspecialchars($conv['agent_nom'] ?? 'Inconnu') ?></strong>
                                    • <?= date('d/m/Y', strtotime($conv['date_creation'])) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="modal-empty-state">
                        <div class="modal-empty-state-icon">📭</div>
                        <p>Aucune conversation précédente</p>
                        <p style="font-size: 12px; margin-top: 4px; color: #d1d5db;">Démarrez une nouvelle avec l'un de nos agents</p>
                    </div>
                <?php endif; ?>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="font-size: 13px; color: #6b7280; margin: 0 0 12px 0; text-align: center;">Ou commencez avec un agent :</p>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                    <?php 
                        // Mapping des agents avec leurs IDs
                        $agents_list = [
                            ['nom' => 'Mathéo', 'icon' => '📐', 'id' => 1],
                            ['nom' => 'Histoire', 'icon' => '📚', 'id' => 2],
                            ['nom' => 'Scolaire', 'icon' => '🎓', 'id' => 3],
                            ['nom' => 'Français', 'icon' => '📝', 'id' => 4]
                        ];
                    ?>
                    <?php foreach ($agents_list as $agent_btn): ?>
                        <button class="modal-agent-quick-btn" 
                                data-agent-name="<?= htmlspecialchars($agent_btn['nom']) ?>"
                                data-agent-id="<?= $agent_btn['id'] ?>">
                            <span style="font-size: 18px; margin-right: 8px;"><?= $agent_btn['icon'] ?></span>
                            <?= htmlspecialchars($agent_btn['nom']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="modalCancelBtn">Fermer</button>
                <button class="modal-btn modal-btn-continue" id="modalContinueBtn" disabled>Continuer</button>
            </div>
        </div>
    </div>

    <!-- Main Conversation Container -->
    <div class="conversation-container">
        <!-- Sidebar with Conversation History -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">
                    <?php if (isset($agent) && $agent): ?>
                        💬 Conversations
                    <?php else: ?>
                        🤖 Sélectionner un agent
                    <?php endif; ?>
                </h3>
            </div>
            
            <?php if (isset($agent) && $agent): ?>
                <!-- Show conversation history for this agent -->
                <div class="conversation-list">
                    <?php if (!empty($conversationHistory)): ?>
                        <?php foreach ($conversationHistory as $conv): ?>
                            <a href="/conversation/<?= $conv['id_conversation'] ?>" 
                               class="conversation-item <?= isset($_GET['conv']) && $_GET['conv'] == $conv['id_conversation'] ? 'active' : '' ?>">
                                <div class="conversation-item-icon">💬</div>
                                <div class="conversation-item-info">
                                    <div class="conversation-item-title"><?= htmlspecialchars(substr($conv['titre'], 0, 40)) ?></div>
                                    <div class="conversation-item-date">
                                        <?= date('d/m/Y H:i', strtotime($conv['date_creation'])) ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="padding: 20px; color: #9ca3af; font-size: 13px; text-align: center;">
                            <div style="font-size: 24px; margin-bottom: 8px;">📭</div>
                            Aucune conversation
                        </div>
                    <?php endif; ?>
                </div>
                
                <div style="padding: 16px; border-top: 1px solid #e5e7eb;">
                    <a href="/conversation" class="btn" style="display: block; text-align: center; background: #f3f4f6; color: #374151; padding: 10px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500;">
                        ← Changer d'agent
                    </a>
                </div>
            <?php else: ?>
                <!-- Show agents list -->
                <div class="agents-list">
                    <?php if (!empty($agents) ?? false): ?>
                        <?php foreach ($agents as $agentItem): ?>
                            <a href="/conversation/agent/<?= $agentItem['id_agent'] ?>" 
                               class="agent-item">
                                <div class="agent-avatar">
                                    <i class="<?= $getAgentIcon($agentItem['nom'], $agentItem['avatar'] ?? '') ?>"></i>
                                </div>
                                <span class="agent-name"><?= htmlspecialchars($agentItem['nom']) ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="padding: 12px; color: var(--text-secondary); font-size: 13px; text-align: center;">
                            Aucun agent disponible
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </aside>

        <!-- Chat Area -->
        <main class="chat-area">
            <?php if (isset($agent) && $agent): ?>
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="agent-avatar" style="width: 44px; height: 44px; font-size: 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="<?= $getAgentIcon($agent['nom'], $agent['avatar'] ?? '') ?>" style="font-size: 24px;"></i>
                    </div>
                    <div class="chat-header-info">
                        <div class="chat-header-title"><?= htmlspecialchars($agent['nom']) ?></div>
                        <div class="chat-header-subtitle">🎓 Assistant spécialisé</div>
                    </div>
                </div>

                <!-- Conversation History -->
                <?php if (!empty($conversationHistory)): ?>
                    <div class="conversation-history">
                        <div class="history-header">
                            <i class="fas fa-history"></i>
                            <span>Historique des conversations</span>
                        </div>
                        <div class="history-list">
                            <?php foreach ($conversationHistory as $conv): ?>
                                <div class="history-item">
                                    <div class="history-title"><?= htmlspecialchars($conv['titre']) ?></div>
                                    <div class="history-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?= date('d/m/Y H:i', strtotime($conv['date_creation'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Messages Container -->
                <div class="messages-container" id="messagesContainer">
                    <div class="message agent">
                        <div class="message-avatar agent" style="display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="<?= $getAgentIcon($agent['nom'], $agent['avatar'] ?? '') ?>"></i>
                        </div>
                        <div>
                            <div class="message-bubble">
                                Salut <?= htmlspecialchars($user['prenom'] ?? 'étudiant') ?> ! 👋 Je suis <?= htmlspecialchars($agent['nom']) ?>, ton assistant IA. Je suis là pour t'aider dans tes apprentissages. N'hésite pas à me poser tes questions ! 📚
                            </div>
                            <div class="message-time">À l'instant</div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-area">
                    <div class="input-wrapper">
                        <textarea class="chat-input" id="messageInput" placeholder="Pose ta question..." rows="1"></textarea>
                    </div>
                    <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>

            <?php else: ?>
                <!-- No Agent Selected -->
                <div class="messages-container">
                    <div class="no-messages select-agent-message">
                        <div class="select-agent-icon">🤖</div>
                        <div class="select-agent-title">Sélectionne un agent</div>
                        <p class="select-agent-text">Choisis un agent dans la liste de gauche pour commencer une conversation</p>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Scripts -->
    <script src="/js/front/conversation.js"></script>
    
    <script>
        // Agent Selection Modal Handler
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('agentSelectionModal');
            const historyItems = document.querySelectorAll('.modal-history-item');
            const agentQuickBtns = document.querySelectorAll('.modal-agent-quick-btn');
            const continueBtn = document.getElementById('modalContinueBtn');
            const cancelBtn = document.getElementById('modalCancelBtn');
            
            let selectedConversationId = null;
            let selectedAgentId = null;
            let selectedAgentName = null;
            
            // Handle history item selection
            historyItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove selection from all items and buttons
                    historyItems.forEach(h => h.classList.remove('selected'));
                    agentQuickBtns.forEach(b => b.classList.remove('selected'));
                    
                    // Add selection to clicked history item
                    this.classList.add('selected');
                    
                    // Store the conversation ID
                    selectedConversationId = this.getAttribute('data-conv-id');
                    selectedAgentId = null;
                    selectedAgentName = null;
                    
                    // Enable continue button
                    continueBtn.disabled = false;
                    continueBtn.classList.add('enabled');
                });
            });
            
            // Handle agent quick button selection
            agentQuickBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove selection from all items and buttons
                    historyItems.forEach(h => h.classList.remove('selected'));
                    agentQuickBtns.forEach(b => b.classList.remove('selected'));
                    
                    // Add selection to clicked button
                    this.classList.add('selected');
                    
                    // Store the agent info
                    selectedAgentName = this.getAttribute('data-agent-name');
                    selectedAgentId = this.getAttribute('data-agent-id');
                    selectedConversationId = null;
                    
                    // Enable continue button
                    continueBtn.disabled = false;
                    continueBtn.classList.add('enabled');
                });
            });
            
            // Handle continue button
            continueBtn.addEventListener('click', async function() {
                if (selectedConversationId) {
                    // Navigate to selected conversation
                    window.location.href = `/conversation/${selectedConversationId}`;
                } else if (selectedAgentId) {
                    // Create new conversation with selected agent
                    try {
                        const response = await fetch('/api/conversation/create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                agent_id: selectedAgentId,
                                agent_name: selectedAgentName
                            })
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            if (data.success && data.conversation_id) {
                                // Redirect to the new conversation
                                window.location.href = `/conversation/${data.conversation_id}`;
                            } else {
                                // Fallback to agent view
                                window.location.href = `/conversation/agent/${selectedAgentId}`;
                            }
                        } else {
                            // Fallback to agent view
                            window.location.href = `/conversation/agent/${selectedAgentId}`;
                        }
                    } catch (error) {
                        console.error('Erreur lors de la création de la conversation:', error);
                        // Fallback to agent view
                        window.location.href = `/conversation/agent/${selectedAgentId}`;
                    }
                }
            });
            
            // Handle cancel button
            cancelBtn.addEventListener('click', function() {
                historyItems.forEach(h => h.classList.remove('selected'));
                agentQuickBtns.forEach(b => b.classList.remove('selected'));
                continueBtn.disabled = true;
                continueBtn.classList.remove('enabled');
                selectedConversationId = null;
                selectedAgentId = null;
                selectedAgentName = null;
            });
        });
    </script>
</body>
</html>
