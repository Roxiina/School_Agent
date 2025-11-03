/**
 * SCHOOL AGENT - JavaScript principal avec gestion RGPD
 * Gestion de l'interactivité, conformité RGPD et UX moderne
 */

// Classe principale de l'application
class SchoolAgent {
    constructor() {
        this.cookieConsent = null;
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeComponents();
        this.initRGPD();
        this.initAnimations();
        console.log('School Agent initialisé avec succès (Design moderne + RGPD)');
    }

    setupEventListeners() {
        // Navigation active
        this.setActiveNavigation();
        
        // Formulaires
        this.setupForms();
        
        // Modales
        this.setupModals();
        
        // Notifications
        this.setupNotifications();

        // Smooth scrolling
        this.setupSmoothScrolling();
    }

    initRGPD() {
        // Vérifier si le consentement a déjà été donné
        const consent = localStorage.getItem('cookieConsent');
        if (!consent) {
            this.showCookieBanner();
        } else {
            this.cookieConsent = JSON.parse(consent);
            this.initTracking();
        }
    }

    showCookieBanner() {
        // Créer le banner de cookies s'il n'existe pas
        if (!document.getElementById('cookieBanner')) {
            const banner = document.createElement('div');
            banner.id = 'cookieBanner';
            banner.className = 'cookie-banner';
            banner.innerHTML = `
                <div class="cookie-content">
                    <div class="cookie-text">
                        <strong>🍪 Respect de votre vie privée</strong><br>
                        Nous utilisons des cookies pour améliorer votre expérience et analyser l'utilisation de notre site. 
                        Vous pouvez accepter tous les cookies ou personnaliser vos préférences.
                        <a href="?page=privacy" style="color: var(--primary-color); text-decoration: underline;">Politique de confidentialité</a>
                    </div>
                    <div class="cookie-actions">
                        <button class="btn btn-secondary" onclick="window.schoolAgent.rejectCookies()">
                            Refuser
                        </button>
                        <button class="btn btn-outline" onclick="window.schoolAgent.showCookiePreferences()">
                            Personnaliser
                        </button>
                        <button class="btn btn-primary" onclick="window.schoolAgent.acceptAllCookies()">
                            Accepter tout
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(banner);
        }

        // Afficher le banner
        setTimeout(() => {
            document.getElementById('cookieBanner').classList.add('show');
        }, 1000);
    }

    acceptAllCookies() {
        this.cookieConsent = {
            necessary: true,
            analytics: true,
            marketing: false,
            timestamp: Date.now()
        };
        this.saveCookieConsent();
        this.hideCookieBanner();
        this.initTracking();
        this.showNotification('Préférences de cookies enregistrées', 'success');
    }

    rejectCookies() {
        this.cookieConsent = {
            necessary: true,
            analytics: false,
            marketing: false,
            timestamp: Date.now()
        };
        this.saveCookieConsent();
        this.hideCookieBanner();
        this.showNotification('Seuls les cookies nécessaires sont utilisés', 'info');
    }

    showCookiePreferences() {
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.id = 'cookiePreferencesModal';
        modal.style.display = 'flex';
        modal.innerHTML = `
            <div class="modal-content" style="max-width: 600px; margin: auto; background: white; padding: 2rem; border-radius: var(--border-radius);">
                <h2 style="margin-bottom: 1.5rem;">🍪 Préférences des cookies</h2>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <input type="checkbox" checked disabled style="margin-right: 0.5rem;">
                        <div>
                            <strong>Cookies nécessaires</strong><br>
                            <small style="color: var(--gray-600);">Requis pour le fonctionnement du site (connexion, session)</small>
                        </div>
                    </label>
                    
                    <label style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <input type="checkbox" id="analyticsConsent" style="margin-right: 0.5rem;">
                        <div>
                            <strong>Cookies d'analyse</strong><br>
                            <small style="color: var(--gray-600);">Nous aident à comprendre comment vous utilisez le site</small>
                        </div>
                    </label>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button class="btn btn-secondary" onclick="window.schoolAgent.closeCookiePreferences()">
                        Annuler
                    </button>
                    <button class="btn btn-primary" onclick="window.schoolAgent.saveCustomCookiePreferences()">
                        Enregistrer les préférences
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        // Fermer en cliquant sur l'overlay
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                this.closeCookiePreferences();
            }
        });
    }

    saveCustomCookiePreferences() {
        const analyticsConsent = document.getElementById('analyticsConsent').checked;
        
        this.cookieConsent = {
            necessary: true,
            analytics: analyticsConsent,
            marketing: false,
            timestamp: Date.now()
        };
        
        this.saveCookieConsent();
        this.closeCookiePreferences();
        this.hideCookieBanner();
        this.initTracking();
        this.showNotification('Préférences de cookies personnalisées enregistrées', 'success');
    }

    closeCookiePreferences() {
        const modal = document.getElementById('cookiePreferencesModal');
        if (modal) {
            modal.remove();
        }
    }

    saveCookieConsent() {
        localStorage.setItem('cookieConsent', JSON.stringify(this.cookieConsent));
        // Enregistrer également côté serveur si nécessaire
        this.sendConsentToServer();
    }

    hideCookieBanner() {
        const banner = document.getElementById('cookieBanner');
        if (banner) {
            banner.classList.remove('show');
            setTimeout(() => banner.remove(), 300);
        }
    }

    sendConsentToServer() {
        // Envoi asynchrone du consentement au serveur
        if (this.cookieConsent) {
            fetch('?page=api&action=cookie_consent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.cookieConsent)
            }).catch(err => console.log('Consent not sent to server:', err));
        }
    }

    initTracking() {
        if (this.cookieConsent?.analytics) {
            // Initialiser Google Analytics ou autre système d'analyse
            console.log('Analytics initialisés');
            // gtag('config', 'GA_TRACKING_ID');
        }
    }

    initAnimations() {
        // Observer pour les animations au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observer tous les éléments avec la classe 'animate-on-scroll'
        document.querySelectorAll('.card, .agent-card, .stat-card').forEach(el => {
            observer.observe(el);
        });
    }

    setupSmoothScrolling() {
        // Gestion du scroll fluide pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    setActiveNavigation() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-menu a');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (currentPath.includes(href) && href !== '/') {
                link.classList.add('active');
            }
        });
    }

    setupForms() {
        // Validation des formulaires
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });

            // Validation en temps réel
            const inputs = form.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('blur', () => {
                    this.validateInput(input);
                });
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('.form-input[required]');
        
        inputs.forEach(input => {
            if (!this.validateInput(input)) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    validateInput(input) {
        const value = input.value.trim();
        const type = input.type;
        let isValid = true;
        let message = '';

        // Supprimer les messages d'erreur existants
        this.removeErrorMessage(input);

        if (input.hasAttribute('required') && !value) {
            message = 'Ce champ est obligatoire';
            isValid = false;
        } else if (type === 'email' && value && !this.isValidEmail(value)) {
            message = 'Adresse email invalide';
            isValid = false;
        } else if (input.minLength && value.length < input.minLength) {
            message = `Minimum ${input.minLength} caractères requis`;
            isValid = false;
        }

        if (!isValid) {
            this.showErrorMessage(input, message);
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }

        return isValid;
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    showErrorMessage(input, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.color = 'var(--danger-color)';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '0.25rem';
        
        input.parentNode.appendChild(errorDiv);
    }

    removeErrorMessage(input) {
        const errorMessage = input.parentNode.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
    }

    setupModals() {
        // Gestion des modales
        const modalTriggers = document.querySelectorAll('[data-modal]');
        const modals = document.querySelectorAll('.modal');
        
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const modalId = trigger.getAttribute('data-modal');
                this.showModal(modalId);
            });
        });

        modals.forEach(modal => {
            const closeBtn = modal.querySelector('.modal-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    this.hideModal(modal);
                });
            }

            // Fermer en cliquant sur l'overlay
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    this.hideModal(modal);
                }
            });
        });
    }

    showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Animation d'entrée
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);
        }
    }

    hideModal(modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    setupNotifications() {
        // Auto-hide des notifications
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.dataset.autoHide !== 'false') {
                setTimeout(() => {
                    this.hideNotification(alert);
                }, 5000);
            }
        });
    }

    hideNotification(notification) {
        notification.style.transition = 'opacity 0.3s ease';
        notification.style.opacity = '0';
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    showNotification(message, type = 'info', autoHide = true) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type}`;
        notification.textContent = message;
        
        if (!autoHide) {
            notification.dataset.autoHide = 'false';
        }

        // Insérer au début du main
        const main = document.querySelector('main');
        if (main) {
            main.insertBefore(notification, main.firstChild);
            
            if (autoHide) {
                setTimeout(() => {
                    this.hideNotification(notification);
                }, 5000);
            }
        }
    }

    initializeComponents() {
        this.initChat();
        this.initTables();
        this.initAgentCards();
    }

    initChat() {
        const chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            // Auto-scroll vers le bas
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Formulaire de chat
        const chatForm = document.querySelector('#chat-form');
        if (chatForm) {
            chatForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.sendMessage();
            });
        }
    }

    async sendMessage() {
        const messageInput = document.querySelector('#message-input');
        const message = messageInput.value.trim();
        
        if (!message) return;

        // Afficher le message utilisateur
        this.addMessageToChat(message, 'user');
        messageInput.value = '';

        // Afficher le loader
        this.showChatLoader();

        try {
            // Simuler un appel API (à remplacer par votre logique)
            const response = await this.callChatAPI(message);
            
            // Masquer le loader
            this.hideChatLoader();
            
            // Afficher la réponse
            this.addMessageToChat(response, 'agent');
        } catch (error) {
            this.hideChatLoader();
            this.addMessageToChat('Désolé, une erreur est survenue.', 'agent');
            console.error('Erreur chat:', error);
        }
    }

    addMessageToChat(message, sender) {
        const chatContainer = document.querySelector('.chat-container');
        if (!chatContainer) return;

        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.innerHTML = `
            <div class="message-content">${message}</div>
            <div class="message-time">${new Date().toLocaleTimeString()}</div>
        `;

        chatContainer.appendChild(messageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    showChatLoader() {
        const chatContainer = document.querySelector('.chat-container');
        if (chatContainer) {
            const loader = document.createElement('div');
            loader.className = 'chat-loader message agent';
            loader.innerHTML = '<div class="loader"></div>';
            chatContainer.appendChild(loader);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }

    hideChatLoader() {
        const loader = document.querySelector('.chat-loader');
        if (loader) {
            loader.remove();
        }
    }

    async callChatAPI(message) {
        // Simuler un délai d'API
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Réponse simulée (à remplacer par votre logique backend)
        const responses = [
            "C'est une excellente question ! Pouvez-vous me donner plus de détails ?",
            "Je vais vous aider avec cela. Voici ce que je peux vous proposer...",
            "D'après mes connaissances, voici la réponse à votre question...",
            "Intéressant ! Laissez-moi analyser cela pour vous."
        ];
        
        return responses[Math.floor(Math.random() * responses.length)];
    }

    initTables() {
        // Tri des tableaux
        const tables = document.querySelectorAll('.table');
        tables.forEach(table => {
            const headers = table.querySelectorAll('th[data-sort]');
            headers.forEach(header => {
                header.style.cursor = 'pointer';
                header.addEventListener('click', () => {
                    this.sortTable(table, header.dataset.sort);
                });
            });
        });
    }

    sortTable(table, column) {
        // Logique de tri simple
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const isAscending = table.dataset.sortDirection !== 'asc';
        
        rows.sort((a, b) => {
            const aText = a.cells[column].textContent.trim();
            const bText = b.cells[column].textContent.trim();
            
            if (isAscending) {
                return aText.localeCompare(bText, undefined, { numeric: true });
            } else {
                return bText.localeCompare(aText, undefined, { numeric: true });
            }
        });
        
        rows.forEach(row => tbody.appendChild(row));
        table.dataset.sortDirection = isAscending ? 'asc' : 'desc';
    }

    initAgentCards() {
        const agentCards = document.querySelectorAll('.agent-card');
        agentCards.forEach(card => {
            card.addEventListener('click', () => {
                const agentId = card.dataset.agentId;
                if (agentId) {
                    this.selectAgent(agentId);
                }
            });
        });
    }

    selectAgent(agentId) {
        // Logique de sélection d'agent
        console.log('Agent sélectionné:', agentId);
        this.showNotification('Agent sélectionné avec succès !', 'success');
    }
}

// Utilitaires
const Utils = {
    formatDate(date) {
        return new Date(date).toLocaleDateString('fr-FR');
    },
    
    formatTime(date) {
        return new Date(date).toLocaleTimeString('fr-FR');
    },
    
    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    },
    
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
};

// Initialisation quand le DOM est prêt
document.addEventListener('DOMContentLoaded', () => {
    window.schoolAgent = new SchoolAgent();
});

// Export pour utilisation dans d'autres fichiers
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { SchoolAgent, Utils };
}