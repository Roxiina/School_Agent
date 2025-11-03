<?php
require __DIR__ . '/../templates/header.php';

// Récupérer les conversations et l'agent
$conversations = [];
$agent = null;
$messages = [];

if (isset($_GET['conversation_id'])) {
    $conversationId = (int)$_GET['conversation_id'];
    // Récupérer les messages de la conversation
    // ... (votre logique PHP)
}
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        background: #ffffff;
    }

    /* Main Chat Container */
    .chat-container {
        display: flex;
        height: calc(100vh - 70px);
        background: #f8fafb;
        gap: 0;
    }

    /* ============ SIDEBAR ============ */
    .chat-sidebar {
        width: 320px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        box-shadow: 1px 0 3px rgba(0, 0, 0, 0.05);
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }

    .btn-new-chat {
        width: 100%;
        padding: 12px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
    }

    .btn-new-chat:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .sidebar-search {
        padding: 12px 20px;
    }

    .search-box {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: #f9fafb;
        transition: all 0.2s ease;
    }

    .search-box:focus {
        outline: none;
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .conversations-list {
        flex: 1;
        overflow-y: auto;
        list-style: none;
        padding: 8px 12px;
    }

    .conv-item {
        margin-bottom: 8px;
    }

    .conv-link {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 12px 12px;
        text-decoration: none;
        color: #4b5563;
        background: transparent;
        border-radius: 8px;
        border-left: 3px solid transparent;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .conv-link:hover {
        background: #f3f4f6;
        border-left-color: #667eea;
        color: #1f2937;
    }

    .conv-link.active {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.08));
        color: #667eea;
        font-weight: 600;
        border-left-color: #667eea;
    }

    .conv-title {
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .conv-time {
        font-size: 12px;
        color: #9ca3af;
    }

    .sidebar-footer {
        padding: 12px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 8px;
    }

    .footer-btn {
        flex: 1;
        height: 36px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 6px;
        cursor: pointer;
        color: #6b7280;
        transition: all 0.2s ease;
        font-size: 14px;
    }

    .footer-btn:hover {
        background: #f3f4f6;
        border-color: #667eea;
        color: #667eea;
    }

    /* ============ MAIN CHAT AREA ============ */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #ffffff;
    }

    /* Chat Header */
    .chat-header {
        padding: 16px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .agent-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .agent-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.25);
        position: relative;
    }

    .agent-avatar::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 12px;
        height: 12px;
        background: #10b981;
        border: 2px solid white;
        border-radius: 50%;
    }

    .agent-details h3 {
        font-size: 15px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 2px;
    }

    .agent-details .status {
        font-size: 12px;
        color: #10b981;
        font-weight: 500;
    }

    .header-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-header {
        width: 36px;
        height: 36px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 8px;
        cursor: pointer;
        color: #667eea;
        font-size: 16px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-header:hover {
        background: #f3f4f6;
        border-color: #667eea;
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.15);
    }

    /* Messages Container */
    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #ffffff;
    }

    .message {
        display: flex;
        gap: 12px;
        animation: slideIn 0.3s ease;
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

    .message.user {
        justify-content: flex-end;
    }

    .message-content {
        max-width: 60%;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.5;
        word-wrap: break-word;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease;
    }

    .message.agent .message-content {
        background: #f3f4f6;
        color: #1f2937;
        border-radius: 12px 12px 12px 4px;
    }

    .message.user .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px 12px 4px 12px;
    }

    .message-time {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
        padding: 0 4px;
    }

    .message.user .message-time {
        color: rgba(255, 255, 255, 0.7);
        text-align: right;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        text-align: center;
        color: #9ca3af;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    .empty-state h2 {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    /* Input Area */
    .chat-input-area {
        padding: 16px 24px;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
    }

    .input-form {
        display: flex;
        gap: 12px;
        align-items: flex-end;
    }

    .input-wrapper {
        flex: 1;
        display: flex;
        align-items: flex-end;
        background: #f9fafb;
        border-radius: 8px;
        padding: 8px 12px;
        border: 1.5px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .input-wrapper:focus-within {
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    #messageInput {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        resize: none;
        max-height: 100px;
        font-family: inherit;
        color: #1f2937;
    }

    #messageInput::placeholder {
        color: #b0b8c1;
    }

    .btn-send {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
    }

    .btn-send:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-send:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Loading */
    .loading-indicator {
        display: flex;
        gap: 6px;
        padding: 12px 16px;
    }

    .loading-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #667eea;
        animation: bounce 1.4s infinite;
    }

    .loading-dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .loading-dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes bounce {
        0%, 60%, 100% {
            opacity: 0.3;
        }
        30% {
            opacity: 1;
        }
    }

    /* Scrollbar */
    .messages-container::-webkit-scrollbar,
    .conversations-list::-webkit-scrollbar {
        width: 6px;
    }

    .messages-container::-webkit-scrollbar-track,
    .conversations-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .messages-container::-webkit-scrollbar-thumb,
    .conversations-list::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }

    .messages-container::-webkit-scrollbar-thumb:hover,
    .conversations-list::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chat-container {
            flex-direction: column;
        }

        .chat-sidebar {
            width: 100%;
            height: auto;
            max-height: 200px;
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }

        .chat-main {
            height: calc(100vh - 270px);
        }

        .message-content {
            max-width: 80%;
        }

        .messages-container {
            padding: 16px;
        }

        .btn-header {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .chat-container {
            height: calc(100vh - 50px);
        }

        .chat-header {
            padding: 12px 16px;
        }

        .agent-avatar {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .agent-details h3 {
            font-size: 14px;
        }

        .message-content {
            max-width: 85%;
            padding: 10px 14px;
            font-size: 13px;
        }

        .chat-input-area {
            padding: 12px 16px;
        }

        .btn-send {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
    }
</style>

<div class="chat-container">
    <!-- Sidebar -->
    <div class="chat-sidebar" id="chatSidebar">
        <div class="sidebar-header">
            <h2>Conversations</h2>
            <button class="btn-new-chat" onclick="startNewConversation()">
                <i class="fas fa-plus"></i> Nouvelle
            </button>
        </div>

        <div class="sidebar-search">
            <input 
                type="text" 
                class="search-box" 
                id="searchBox" 
                placeholder="Rechercher..."
            >
        </div>

        <ul class="conversations-list" id="conversationsList">
            <!-- Loaded dynamically -->
        </ul>

        <div class="sidebar-footer">
            <button class="footer-btn" id="btnClearAll" title="Supprimer tout">
                <i class="fas fa-trash"></i>
            </button>
            <button class="footer-btn" id="btnSettings" title="Paramètres">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>

    <!-- Main Chat -->
    <div class="chat-main">
        <!-- Header -->
        <div class="chat-header">
            <div class="agent-info">
                <div class="agent-avatar">🤖</div>
                <div class="agent-details">
                    <h3>Agent IA</h3>
                    <span class="status">Actif</span>
                </div>
            </div>

            <div class="header-buttons">
                <button class="btn-header" id="btnToggleSidebar" title="Menu">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="btn-header" id="btnInfo" title="Infos">
                    <i class="fas fa-info-circle"></i>
                </button>
                <button class="btn-header" id="btnMore" title="Plus">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>

        <!-- Messages -->
        <div class="messages-container" id="messagesContainer">
            <div class="empty-state">
                <div class="empty-state-icon">💬</div>
                <h2>Démarrez une conversation</h2>
                <p>Cliquez sur une conversation ou créez-en une nouvelle</p>
            </div>
        </div>

        <!-- Input -->
        <div class="chat-input-area">
            <form class="input-form" id="messageForm" onsubmit="sendMessage(event)">
                <div class="input-wrapper">
                    <textarea 
                        id="messageInput" 
                        placeholder="Écrivez votre message..." 
                        rows="1"
                    ></textarea>
                </div>
                <button type="submit" class="btn-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textarea = document.getElementById('messageInput');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });

    // Send message
    function sendMessage(e) {
        e.preventDefault();
        const message = textarea.value.trim();
        if (!message) return;

        // Add user message to display
        addMessage(message, 'user');
        textarea.value = '';
        textarea.style.height = 'auto';

        // Send to server (implement your logic)
        // fetch(...) 
    }

    function addMessage(text, sender) {
        const container = document.getElementById('messagesContainer');
        if (container.querySelector('.empty-state')) {
            container.innerHTML = '';
        }

        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.innerHTML = `
            <div class="message-content">
                ${text}
                <div class="message-time">${new Date().toLocaleTimeString()}</div>
            </div>
        `;
        container.appendChild(messageDiv);
        container.scrollTop = container.scrollHeight;
    }

    // Toggle sidebar on mobile
    document.getElementById('btnToggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('chatSidebar');
        sidebar.style.display = sidebar.style.display === 'none' ? 'flex' : 'none';
    });

    // Start new conversation
    function startNewConversation() {
        alert('Nouvelle conversation créée');
    }
</script>
