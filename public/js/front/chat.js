/**
 * Chat.js
 * 
 * Rôle: Gérer l'interface de chat IA AJAX
 * 
 * Fonctionnalités:
 * - Envoi de messages via AJAX
 * - Affichage des messages en temps réel
 * - Indicateur de saisie
 * - Auto-scroll vers les nouveaux messages
 * - Gestion des erreurs
 * - Redimensionnement automatique du textarea
 * - Protection XSS
 * 
 * Utilisation: Intégré automatiquement via <script> tag dans show.php
 */

class ChatApp {
    constructor() {
        this.chatMessages = document.querySelector('.chat-messages');
        this.form = document.querySelector('.chat-input-form');
        this.textarea = document.querySelector('.chat-textarea');
        this.submitBtn = document.querySelector('.chat-submit-btn');
        
        if (this.form) {
            this.init();
        }
    }

    init() {
        // Gestion du submit du formulaire
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        
        // Auto-redimensionnement du textarea
        this.textarea.addEventListener('input', () => this.autoResizeTextarea());
        
        // Scroll initial vers le bas
        this.scrollToBottom();
    }

    /**
     * Gère l'envoi du message
     */
    async handleSubmit(e) {
        e.preventDefault();
        
        const message = this.textarea.value.trim();
        if (!message) return;
        
        // Récupérer l'ID de conversation depuis le data attribute du formulaire
        let conversationId = this.form.getAttribute('data-conversation-id');
        
        // Fallback: chercher dans l'URL
        if (!conversationId) {
            const params = new URLSearchParams(window.location.search);
            conversationId = params.get('id');
        }
        
        // Si pas d'ID, c'est une nouvelle conversation - faire un POST traditionnel d'abord
        if (!conversationId) {
            // Récupérer l'agent_id du formulaire (si c'est une nouvelle conversation)
            const agentIdInput = this.form.querySelector('input[name="agent_id"]');
            if (agentIdInput) {
                // C'est une nouvelle conversation - faire un POST traditionnel
                this.form.submit();
                return;
            }
            
            // Sinon, c'est une erreur
            this.showError('ID de conversation manquant');
            return;
        }

        // Désactiver le bouton et afficher le message utilisateur
        this.submitBtn.disabled = true;
        this.submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        // Afficher le message utilisateur immédiatement
        this.displayUserMessage(message);
        this.textarea.value = '';
        this.autoResizeTextarea();
        
        try {
            // Afficher l'indicateur de saisie
            this.showTypingIndicator();
            
            // Envoyer le message au serveur
            const response = await fetch(`/api/ia/ask.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    conversation_id: conversationId,
                    question: message
                })
            });

            // Vérifier le statut HTTP
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            
            // Enlever l'indicateur de saisie
            this.removeTypingIndicator();
            
            if (data.success && data.response) {
                this.displayAIMessage(data.response);
            } else {
                this.showError(data.message || 'Erreur lors de la réponse de l\'IA');
            }
        } catch (error) {
            console.error('Erreur Chat:', error);
            console.error('Message d\'erreur:', error.message);
            this.removeTypingIndicator();
            
            // Message d'erreur plus spécifique
            if (error instanceof TypeError) {
                this.showError('Erreur de connexion. Vérifiez que le serveur fonctionne.');
            } else if (error.message.includes('HTTP')) {
                this.showError('Erreur serveur: ' + error.message);
            } else {
                this.showError('Erreur: ' + error.message);
            }
        } finally {
            this.submitBtn.disabled = false;
            this.submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i><span>Envoyer</span>';
            this.textarea.focus();
        }
    }

    /**
     * Affiche le message de l'utilisateur
     */
    displayUserMessage(text) {
        const messageGroup = document.createElement('div');
        messageGroup.className = 'message-group';
        messageGroup.style.animation = 'fadeIn 0.3s ease-in forwards';
        
        const message = document.createElement('div');
        message.className = 'message user-message';
        
        const content = document.createElement('div');
        content.className = 'message-content';
        content.innerHTML = `<p>${this.escapeHtml(text)}</p>`;
        
        message.appendChild(content);
        messageGroup.appendChild(message);
        this.chatMessages.appendChild(messageGroup);
        
        this.scrollToBottom();
    }

    /**
     * Affiche le message de l'IA
     */
    displayAIMessage(text) {
        const messageGroup = document.createElement('div');
        messageGroup.className = 'message-group';
        messageGroup.style.animation = 'fadeIn 0.3s ease-in forwards';
        
        const message = document.createElement('div');
        message.className = 'message ai-message';
        
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.innerHTML = '<i class="fas fa-robot"></i>';
        
        const content = document.createElement('div');
        content.className = 'message-content';
        content.innerHTML = `
            <p class="message-author">Assistant IA</p>
            <p>${this.formatText(text)}</p>
        `;
        
        message.appendChild(avatar);
        message.appendChild(content);
        messageGroup.appendChild(message);
        this.chatMessages.appendChild(messageGroup);
        
        this.scrollToBottom();
    }

    /**
     * Affiche l'indicateur de saisie
     */
    showTypingIndicator() {
        const messageGroup = document.createElement('div');
        messageGroup.className = 'message-group typing-group';
        messageGroup.id = 'typing-indicator';
        
        const message = document.createElement('div');
        message.className = 'message ai-message';
        
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.innerHTML = '<i class="fas fa-robot"></i>';
        
        const content = document.createElement('div');
        content.className = 'message-content';
        content.innerHTML = `
            <div class="typing-indicator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;
        
        message.appendChild(avatar);
        message.appendChild(content);
        messageGroup.appendChild(message);
        this.chatMessages.appendChild(messageGroup);
        
        this.scrollToBottom();
    }

    /**
     * Enlève l'indicateur de saisie
     */
    removeTypingIndicator() {
        const indicator = document.getElementById('typing-indicator');
        if (indicator) {
            indicator.remove();
        }
    }

    /**
     * Affiche une erreur
     */
    showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-circle"></i>
            <span>${this.escapeHtml(message)}</span>
        `;
        
        // Insérer avant le formulaire d'input
        const inputContainer = document.querySelector('.chat-input-container');
        inputContainer.parentNode.insertBefore(errorDiv, inputContainer);
        
        // Enlever après 5 secondes
        setTimeout(() => errorDiv.remove(), 5000);
    }

    /**
     * Auto-redimensionne le textarea
     */
    autoResizeTextarea() {
        this.textarea.style.height = 'auto';
        this.textarea.style.height = Math.min(this.textarea.scrollHeight, 150) + 'px';
    }

    /**
     * Scroll vers le bas des messages
     */
    scrollToBottom() {
        setTimeout(() => {
            this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
        }, 100);
    }

    /**
     * Formate le texte (retours à la ligne, etc)
     */
    formatText(text) {
        return this.escapeHtml(text)
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.+?)\*/g, '<em>$1</em>');
    }

    /**
     * Protection XSS - échappe le HTML
     */
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialiser au chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    new ChatApp();
});

// Style pour l'indicateur de saisie (injecté dynamiquement)
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-10px);
        }
    }

    .typing-indicator {
        display: flex;
        gap: 4px;
        padding: 8px 12px;
    }

    .typing-indicator span {
        width: 8px;
        height: 8px;
        background-color: currentColor;
        border-radius: 50%;
        animation: typing 1.4s infinite;
        opacity: 0.7;
    }

    .typing-indicator span:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    .error-message {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        background-color: #fee2e2;
        border-left: 4px solid #ef4444;
        color: #991b1b;
        border-radius: 4px;
        margin-bottom: 16px;
        animation: slideDown 0.3s ease;
    }

    .error-message i {
        font-size: 1.2rem;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;

if (document.head) {
    document.head.appendChild(styleSheet);
}
