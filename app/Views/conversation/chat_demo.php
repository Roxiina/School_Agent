<?php
require __DIR__ . '/../templates/header.php';

// Variables de test pour afficher la page chat avec des messages
$agent = [
    'id' => 1,
    'nom' => 'Agent Mathéo',
    'description' => 'Agent spécialisé en mathématiques'
];

$messages = [
    [
        'id' => 1,
        'question' => 'Bonjour, peux-tu m\'aider avec les équations ?',
        'reponse' => 'Bien sûr ! Les équations sont ma spécialité. Quelle est ta question ?',
        'created_at' => date('Y-m-d H:i:s', time() - 3600)
    ],
    [
        'id' => 2,
        'question' => 'Comment résoudre x² + 2x + 1 = 0 ?',
        'reponse' => 'C\'est une équation du second degré. Utilise la formule du discriminant : Δ = b² - 4ac. Dans ton cas : Δ = 4 - 4 = 0',
        'created_at' => date('Y-m-d H:i:s', time() - 1800)
    ],
    [
        'id' => 3,
        'question' => 'Merci beaucoup !',
        'reponse' => 'De rien ! As-tu d\'autres questions ?',
        'created_at' => date('Y-m-d H:i:s', time() - 600)
    ]
];

$conversation = [
    'id' => 1,
    'titre' => 'Révision équations mathématiques',
    'id_agent' => 1,
    'id_user' => 1,
    'created_at' => date('Y-m-d H:i:s', time() - 7200)
];
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

    .conversations-list {
        flex: 1;
        overflow-y: auto;
        list-style: none;
        padding: 8px 12px;
    }

    .conv-link {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 12px 12px;
        text-decoration: none;
        color: #4b5563;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.08));
        border-radius: 8px;
        border-left: 3px solid #667eea;
        transition: all 0.2s ease;
        cursor: pointer;
        margin-bottom: 8px;
        font-weight: 600;
        color: #667eea;
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

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Scrollbar */
    .messages-container::-webkit-scrollbar {
        width: 6px;
    }

    .messages-container::-webkit-scrollbar-track {
        background: transparent;
    }

    .messages-container::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }

    .messages-container::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<div class="chat-container">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <div class="sidebar-header">
            <h2>💬 Conversations</h2>
            <button class="btn-new-chat">
                <i class="fas fa-comment-circle-plus"></i>
                <span>Nouvelle</span>
            </button>
        </div>

        <ul class="conversations-list">
            <li>
                <a class="conv-link">
                    📐 Révision équations mathématiques
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Chat -->
    <div class="chat-main">
        <!-- Header -->
        <div class="chat-header">
            <div class="agent-info">
                <div class="agent-avatar">🤖</div>
                <div class="agent-details">
                    <h3><?php echo htmlspecialchars($agent['nom']); ?></h3>
                    <span class="status">Actif</span>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="messages-container">
            <?php foreach ($messages as $index => $msg): ?>
                <!-- Message Agent -->
                <?php if ($index % 2 == 0): ?>
                    <div class="message agent">
                        <div class="message-content">
                            <?php echo htmlspecialchars($msg['reponse']); ?>
                            <div class="message-time"><?php echo date('H:i', strtotime($msg['created_at'])); ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Message Utilisateur -->
                <div class="message user">
                    <div class="message-content">
                        <?php echo htmlspecialchars($msg['question']); ?>
                        <div class="message-time"><?php echo date('H:i', strtotime($msg['created_at'])); ?></div>
                    </div>
                </div>

                <!-- Message Agent Réponse -->
                <?php if ($index % 2 != 0): ?>
                    <div class="message agent">
                        <div class="message-content">
                            <?php echo htmlspecialchars($msg['reponse']); ?>
                            <div class="message-time"><?php echo date('H:i', strtotime($msg['created_at'])); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Input -->
        <div class="chat-input-area">
            <form class="input-form">
                <div class="input-wrapper">
                    <textarea placeholder="Écrivez votre message..." rows="1"></textarea>
                </div>
                <button type="submit" class="btn-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>
