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
        background: linear-gradient(135deg, #f8fafb 0%, #f0f2f8 100%);
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

    .btn-new-chat i {
        font-size: 16px;
    }

    .btn-new-chat span {
        display: inline;
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
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .footer-btn i {
        font-size: 14px;
    }

    .footer-btn:hover {
        background: #f3f4f6;
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-1px);
    }

    /* ============ MAIN CHAT AREA ============ */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: transparent;
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

    .btn-header i {
        font-size: 16px;
    }

    .btn-header:hover {
        background: #f3f4f6;
        border-color: #667eea;
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.15);
        transform: translateY(-1px);
    }

    .btn-header:active {
        transform: translateY(0);
    }

    /* Messages Container */
    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: transparent;
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
        background: transparent;
        border-top: none;
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
        flex-shrink: 0;
    }

    .btn-send i {
        font-size: 16px;
    }

    .btn-send:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-send:active:not(:disabled) {
        transform: translateY(0);
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

    /* ======================== MODAL STYLES ======================== */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .modal.active {
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
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #9ca3af;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .modal-close:hover {
        color: #1f2937;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .setting-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .setting-group label {
        font-weight: 500;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .setting-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .setting-group select {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        color: #374151;
    }

    .agent-info-box {
        background: linear-gradient(135deg, #f8fafb 0%, #f0f2f8 100%);
        padding: 16px;
        border-radius: 8px;
    }

    .agent-info-box h3 {
        color: #1f2937;
        margin-bottom: 12px;
        font-size: 16px;
    }

    .agent-info-box p {
        margin: 6px 0;
        color: #4b5563;
        font-size: 14px;
    }

    .agent-info-box h4 {
        color: #667eea;
        margin-top: 15px;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .agent-info-box ul {
        list-style: none;
        padding-left: 0;
    }

    .agent-info-box li {
        padding: 6px 0;
        color: #4b5563;
        font-size: 14px;
    }

    .option-group {
        margin-bottom: 12px;
    }

    .option-btn {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.2s ease;
        text-align: left;
    }

    .option-btn:hover {
        background: #f3f4f6;
        border-color: #667eea;
    }

    .option-btn i {
        font-size: 20px;
        color: #667eea;
        min-width: 30px;
        text-align: center;
    }

    .option-btn h4 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
    }

    .option-btn p {
        margin: 2px 0 0 0;
        font-size: 12px;
        color: #9ca3af;
    }

    .btn-primary,
    .btn-secondary {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #1f2937;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .btn-danger {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        background: #ef4444;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

        .modal-content {
            width: 95%;
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
            <h2>💬 Conversations</h2>
            <button class="btn-new-chat" onclick="startNewConversation()" title="Créer une nouvelle conversation">
                <i class="fas fa-comment-circle-plus"></i>
                <span>Nouvelle</span>
            </button>
        </div>

        <div class="sidebar-search">
            <div style="position: relative;">
                <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 14px;"></i>
                <input 
                    type="text" 
                    class="search-box" 
                    id="searchBox" 
                    placeholder="Rechercher..."
                    style="padding-left: 36px;"
                >
            </div>
        </div>

        <ul class="conversations-list" id="conversationsList">
            <!-- Loaded dynamically -->
        </ul>

        <div class="sidebar-footer">
            <button class="footer-btn" id="btnClearAll" title="Supprimer toutes les conversations">
                <i class="fas fa-trash-alt"></i>
            </button>
            <button class="footer-btn" id="btnSettings" title="Paramètres">
                <i class="fas fa-sliders-h"></i>
            </button>
            <button class="footer-btn" id="btnDownload" title="Télécharger">
                <i class="fas fa-download"></i>
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
                <button class="btn-header" id="btnToggleSidebar" title="Afficher/Masquer le menu">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="btn-header" id="btnInfo" title="Informations sur l'agent">
                    <i class="fas fa-circle-info"></i>
                </button>
                <button class="btn-header" id="btnMore" title="Plus d'options">
                    <i class="fas fa-ellipsis-vertical"></i>
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
                <button type="submit" class="btn-send" title="Envoyer le message">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ======================== AUTO-RESIZE TEXTAREA ========================
    const textarea = document.getElementById('messageInput');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });

    // ======================== SEND MESSAGE ========================
    function sendMessage(e) {
        e.preventDefault();
        const message = textarea.value.trim();
        if (!message) return;

        // Add user message to display
        addMessage(message, 'user');
        textarea.value = '';
        textarea.style.height = 'auto';

        // Send to server
        const conversationId = new URLSearchParams(window.location.search).get('id');
        if (conversationId) {
            fetch('?page=message/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'conversation_id=' + conversationId + '&message=' + encodeURIComponent(message)
            })
            .then(response => response.json())
            .catch(err => console.error('Erreur:', err));
        }
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

    // ======================== SEARCH CONVERSATIONS ========================
    const searchBox = document.getElementById('searchBox');
    searchBox.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const conversations = document.querySelectorAll('.conversation-item');
        
        conversations.forEach(conv => {
            const title = conv.textContent.toLowerCase();
            conv.style.display = title.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // ======================== BUTTON EVENTS ========================

    // 1. Toggle Sidebar
    document.getElementById('btnToggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('chatSidebar');
        sidebar.style.display = sidebar.style.display === 'none' ? 'flex' : 'none';
    });

    // 2. Start New Conversation
    function startNewConversation() {
        window.location.href = '?page=conversation/create';
    }

    // 3. Clear All Conversations
    document.getElementById('btnClearAll').addEventListener('click', function() {
        showDeleteAllModal();
    });

    // 4. Settings
    document.getElementById('btnSettings').addEventListener('click', function() {
        showSettingsModal();
    });

    // 5. Download Conversations
    document.getElementById('btnDownload').addEventListener('click', function() {
        fetch('?page=conversation/export')
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'conversations_' + new Date().getTime() + '.json';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                a.remove();
                alert('✅ Fichier téléchargé');
            })
            .catch(err => {
                console.error('Erreur:', err);
                alert('❌ Erreur lors du téléchargement');
            });
    });

    // 6. Agent Info
    document.getElementById('btnInfo').addEventListener('click', function() {
        showAgentInfoModal();
    });

    // 7. More Options
    document.getElementById('btnMore').addEventListener('click', function() {
        showMoreOptionsModal();
    });

    // ======================== MODALS ========================

    function showSettingsModal() {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>⚙️ Paramètres</h2>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="setting-group">
                        <label>
                            <input type="checkbox" checked> Mode sombre
                        </label>
                    </div>
                    <div class="setting-group">
                        <label>
                            <input type="checkbox" checked> Notifications
                        </label>
                    </div>
                    <div class="setting-group">
                        <label>Langue</label>
                        <select>
                            <option>Français</option>
                            <option>English</option>
                            <option>Español</option>
                        </select>
                    </div>
                    <div class="setting-group">
                        <label>
                            <input type="checkbox"> Historique publique
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-primary">Sauvegarder</button>
                    <button class="btn-secondary modal-close">Fermer</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        setupModalEvents(modal);
    }

    function showAgentInfoModal() {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>ℹ️ Informations de l'Agent</h2>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="agent-info-box">
                        <h3>🤖 Agent IA Intelligent</h3>
                        <p><strong>Version:</strong> 2.0</p>
                        <p><strong>Statut:</strong> ✅ En ligne</p>
                        <p><strong>Temps de réponse:</strong> &lt; 2s</p>
                        
                        <h4>Domaines de compétence:</h4>
                        <ul>
                            <li>📐 Mathématiques (Algèbre, Géométrie, Calcul)</li>
                            <li>🔬 Sciences (Physique, Chimie, Biologie)</li>
                            <li>🌍 Langues (Français, English, Español)</li>
                            <li>📚 Littérature et Histoire-Géographie</li>
                        </ul>
                        
                        <h4>Capacités:</h4>
                        <ul>
                            <li>✨ Explications détaillées</li>
                            <li>📊 Exercices pratiques</li>
                            <li>🎯 Évaluations personnalisées</li>
                            <li>💡 Suggestions d'amélioration</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary modal-close">Fermer</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        setupModalEvents(modal);
    }

    function showMoreOptionsModal() {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>⋮ Plus d'options</h2>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="option-group">
                        <button class="option-btn">
                            <i class="fas fa-file-export"></i>
                            <div>
                                <h4>📋 Exporter cette conversation</h4>
                                <p>Télécharger en PDF ou JSON</p>
                            </div>
                        </button>
                    </div>
                    <div class="option-group">
                        <button class="option-btn">
                            <i class="fas fa-share"></i>
                            <div>
                                <h4>🔄 Partager</h4>
                                <p>Partager avec d'autres utilisateurs</p>
                            </div>
                        </button>
                    </div>
                    <div class="option-group">
                        <button class="option-btn">
                            <i class="fas fa-archive"></i>
                            <div>
                                <h4>🎯 Archiver</h4>
                                <p>Archiver cette conversation</p>
                            </div>
                        </button>
                    </div>
                    <div class="option-group">
                        <button class="option-btn">
                            <i class="fas fa-star"></i>
                            <div>
                                <h4>⭐ Marquer comme important</h4>
                                <p>Ajouter aux favoris</p>
                            </div>
                        </button>
                    </div>
                    <div class="option-group">
                        <button class="option-btn">
                            <i class="fas fa-edit"></i>
                            <div>
                                <h4>📝 Renommer</h4>
                                <p>Modifier le titre de la conversation</p>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary modal-close">Fermer</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        setupModalEvents(modal);
    }

    function setupModalEvents(modal) {
        const closeButtons = modal.querySelectorAll('.modal-close');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                modal.classList.remove('active');
                setTimeout(() => modal.remove(), 300);
            });
        });

        // Fermer en cliquant en dehors
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
                setTimeout(() => modal.remove(), 300);
            }
        });

        // Option buttons
        const optionBtns = modal.querySelectorAll('.option-btn');
        optionBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const text = btn.querySelector('h4').textContent;
                alert('Action: ' + text);
                modal.classList.remove('active');
                setTimeout(() => modal.remove(), 300);
            });
        });
    }

    function showDeleteAllModal() {
        const modal = document.createElement('div');
        modal.className = 'modal active';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>⚠️ Supprimer toutes les conversations</h2>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <p style="color: #ef4444; font-weight: 600; margin-bottom: 12px;">
                        ⚠️ Cette action est irréversible !
                    </p>
                    <p style="color: #4b5563; margin-bottom: 20px;">
                        Êtes-vous absolument certain de vouloir supprimer TOUTES vos conversations ? 
                        Vous ne pourrez pas les récupérer.
                    </p>
                    <div style="background: #fef2f2; border: 1px solid #fee2e2; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                        <p style="margin: 0; color: #991b1b; font-size: 13px;">
                            📋 Conseil: Téléchargez vos conversations avant de les supprimer.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary modal-close">Annuler</button>
                    <button class="btn-danger" onclick="confirmDeleteAll()">
                        <i class="fas fa-trash-alt" style="margin-right: 6px;"></i>
                        Supprimer définitivement
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        setupModalEvents(modal);
    }

    function confirmDeleteAll() {
        fetch('?page=conversation/deleteAll', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Toutes les conversations ont été supprimées');
                    location.reload();
                } else {
                    alert('❌ Erreur: ' + data.message);
                }
            })
            .catch(err => {
                console.error('Erreur:', err);
                alert('❌ Erreur lors de la suppression');
            });
    }
</script>
