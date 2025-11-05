/**
 * Conversation Page - JavaScript
 * Gère l'interface de chat et les interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeConversation();
});

function initializeConversation() {
    const textarea = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const messagesContainer = document.getElementById('messagesContainer');

    if (!textarea) return;

    // Auto-resize textarea
    textarea.addEventListener('input', autoResizeTextarea);

    // Submit on Enter (Ctrl+Enter on multi-line)
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            if (e.ctrlKey || e.shiftKey) {
                // Allow new line
                return;
            }
            // Submit on Enter alone
            e.preventDefault();
            sendMessage();
        }
    });

    // Send button click
    if (sendBtn) {
        sendBtn.addEventListener('click', sendMessage);
    }

    // Focus on input
    setTimeout(() => {
        textarea.focus();
    }, 100);

    // Scroll to bottom on load
    if (messagesContainer) {
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 200);
    }
}

/**
 * Auto-resize textarea height
 */
function autoResizeTextarea() {
    const textarea = document.getElementById('messageInput');
    if (!textarea) return;

    textarea.style.height = 'auto';
    const newHeight = Math.min(textarea.scrollHeight, 120);
    textarea.style.height = newHeight + 'px';
}

/**
 * Send message function
 */
function sendMessage() {
    const input = document.getElementById('messageInput');
    const message = input?.value.trim();

    if (!message) return;

    const messagesContainer = document.getElementById('messagesContainer');
    if (!messagesContainer) return;

    // Create user message element
    const userMessageDiv = createMessageElement(message, 'user');
    messagesContainer.appendChild(userMessageDiv);

    // Clear input and reset height
    if (input) {
        input.value = '';
        input.style.height = 'auto';
    }

    // Scroll to bottom
    setTimeout(() => {
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }, 100);

    // Simulate agent response
    simulateAgentResponse(messagesContainer);
}

/**
 * Create a message element
 */
function createMessageElement(text, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;

    const avatarDiv = document.createElement('div');
    avatarDiv.className = `message-avatar ${type}`;

    // Get user initial or agent initial
    if (type === 'user') {
        // Get from page data or use default
        const userInitial = getUserInitial();
        avatarDiv.textContent = userInitial;
    } else {
        const agentInitial = getAgentInitial();
        avatarDiv.textContent = agentInitial;
    }

    const contentDiv = document.createElement('div');
    contentDiv.innerHTML = `
        <div class="message-bubble">${escapeHtml(text)}</div>
        <div class="message-time">${getCurrentTime()}</div>
    `;

    messageDiv.appendChild(avatarDiv);
    messageDiv.appendChild(contentDiv);

    return messageDiv;
}

/**
 * Simulate agent response
 */
function simulateAgentResponse(messagesContainer) {
    const responses = [
        'C\'est une excellente question ! 🤔',
        'Laisse-moi réfléchir à ça... ⏳',
        'Je traite ta demande... 🧠',
        'Hmm, intéressant ! Attends une seconde... 💭',
        'Je cherche la meilleure explication... 📚'
    ];

    const randomResponse = responses[Math.floor(Math.random() * responses.length)];

    setTimeout(() => {
        const agentMessageDiv = createMessageElement(randomResponse, 'agent');
        messagesContainer.appendChild(agentMessageDiv);

        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }, 500 + Math.random() * 500);
}

/**
 * Get user initial from page data
 */
function getUserInitial() {
    // Try to get from navbar or other sources
    const navWelcome = document.querySelector('.nav-welcome');
    if (navWelcome) {
        const text = navWelcome.textContent;
        // Extract first letter after "Bonjour"
        const match = text.match(/Bonjour\s+(\w)/);
        if (match) return match[1].toUpperCase();
    }
    return 'U'; // Default: User
}

/**
 * Get agent initial from chat header
 */
function getAgentInitial() {
    const chatHeader = document.querySelector('.chat-header-title');
    if (chatHeader) {
        const text = chatHeader.textContent.trim();
        return text.charAt(0).toUpperCase();
    }
    return 'A'; // Default: Agent
}

/**
 * Get current time in HH:MM format
 */
function getCurrentTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}

/**
 * Escape HTML to prevent XSS
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Prevent send button if empty
 */
document.addEventListener('input', function(e) {
    if (e.target.id === 'messageInput') {
        const sendBtn = document.getElementById('sendBtn');
        const isEmpty = !e.target.value.trim();

        if (sendBtn) {
            sendBtn.disabled = isEmpty;
        }
    }
});

// Initialize send button state on load
window.addEventListener('load', function() {
    const input = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');

    if (input && sendBtn) {
        sendBtn.disabled = !input.value.trim();
    }
});
