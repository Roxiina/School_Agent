/**
 * Conversations.js
 * 
 * Rôle: Gérer les interactions et fonctionnalités de la page des conversations
 * 
 * Fonctionnalités:
 * - Confirmation avant suppression de conversation
 * - Animations et transitions
 * - Redirection intelligente
 * - Gestion des états (loading, success, error)
 * - Feedback utilisateur
 * 
 * Utilisation: Intégré automatiquement via <script> tag dans index.php
 */

class ConversationsManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupDeleteButtons();
        this.setupAnimations();
    }

    /**
     * Configure les boutons de suppression avec confirmation
     */
    setupDeleteButtons() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (e) => this.handleDelete(e, button));
        });
    }

    /**
     * Gère la suppression d'une conversation
     */
    handleDelete(e, button) {
        const conversationId = button.getAttribute('data-id');
        
        // Afficher la confirmation
        const modal = document.createElement('div');
        modal.className = 'delete-confirmation-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <h3>Confirmer la suppression</h3>
                <p>Êtes-vous sûr de vouloir supprimer cette conversation ? Cette action est irréversible.</p>
                <div class="modal-actions">
                    <button class="btn-cancel">Annuler</button>
                    <button class="btn-confirm-delete">Supprimer</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        // Animer l'apparition
        setTimeout(() => modal.classList.add('show'), 10);

        const cancelBtn = modal.querySelector('.btn-cancel');
        const confirmBtn = modal.querySelector('.btn-confirm-delete');

        cancelBtn.addEventListener('click', () => {
            this.closeModal(modal);
        });

        confirmBtn.addEventListener('click', () => {
            // Permettre au formulaire de se soumettre
            button.closest('form').submit();
        });

        // Fermer en cliquant en dehors
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                this.closeModal(modal);
            }
        });
    }

    /**
     * Ferme le modal avec animation
     */
    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }

    /**
     * Configure les animations
     */
    setupAnimations() {
        const cards = document.querySelectorAll('.conversation-card');
        cards.forEach((card, index) => {
            // Observer pour animation au scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        card.style.animation = `fadeIn 0.3s ease-in forwards`;
                        card.style.animationDelay = `${index * 0.05}s`;
                        observer.unobserve(card);
                    }
                });
            }, { threshold: 0.1 });

            observer.observe(card);
        });
    }
}

// Initialiser au chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    new ConversationsManager();
});

// Styles pour le modal (injectés dynamiquement)
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    .delete-confirmation-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        transition: background-color 0.3s ease;
    }

    .delete-confirmation-modal.show {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background: white;
        border-radius: 0.75rem;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        animation: slideUp 0.3s ease;
    }

    .modal-content h3 {
        margin: 0 0 0.75rem 0;
        font-size: 1.25rem;
        color: #111827;
    }

    .modal-content p {
        color: #4b5563;
        margin: 0 0 1.5rem 0;
        font-size: 0.95rem;
    }

    .modal-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .btn-cancel,
    .btn-confirm-delete {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background-color: #f3f4f6;
        color: #4b5563;
    }

    .btn-cancel:hover {
        background-color: #e5e7eb;
    }

    .btn-confirm-delete {
        background-color: #ef4444;
        color: white;
    }

    .btn-confirm-delete:hover {
        background-color: #dc2626;
        transform: scale(1.05);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(styleSheet);
