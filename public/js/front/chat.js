/**
 * chat.js - Gestion simple du chat
 */

document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.querySelector('.messages-container');
    const chatInput = document.querySelector('.chat-input');
    
    // Fonction pour scroller en bas
    function scrollToBottom() {
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }
    
    // Scroll initial au chargement
    scrollToBottom();
    
    // Auto-resize du textarea
    if (chatInput) {
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 150) + 'px';
        });
        
        // Ctrl+Enter pour envoyer
        chatInput.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                const form = this.closest('form');
                if (form) form.submit();
            }
        });
    }
    
    // Après le rechargement de la page (après POST), scroller en bas
    if (window.performance) {
        const perfEntries = window.performance.getEntriesByType('navigation');
        if (perfEntries.length > 0 && perfEntries[0].type === 'reload') {
            setTimeout(scrollToBottom, 100);
        }
    }
});