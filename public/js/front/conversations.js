/**
 * conversations.js
 * JavaScript pour la page de liste des conversations
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('Conversations Page - Initialized');

    // Animer les cartes au scroll
    const conversationCards = document.querySelectorAll('.conversation-card');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    conversationCards.forEach(card => {
        observer.observe(card);
    });

    // Confirmation avant suppression
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // La confirmation est déjà dans le HTML avec onsubmit
            // On peut ajouter un feedback visuel ici
            const button = this.querySelector('.btn-delete');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;
        });
    });

    // Effet de hover sur les cartes
    conversationCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
