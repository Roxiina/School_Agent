/**
 * SCHOOL AGENT - JavaScript Principal
 * Gestion des interactions et animations du site
 */

class SchoolAgent {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initAnimations();
        this.setupForms();
        this.setupSearch();
        this.setupFloatingShapes();
    }

    setupEventListeners() {
        // Navigation mobile
        const mobileToggle = document.querySelector('.mobile-toggle');
        const navLinks = document.querySelector('.nav-links');
        
        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }

        // Smooth scrolling pour les liens
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Fermeture des modales en cliquant à l'extérieur
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                this.closeModal();
            }
        });

        // Gestion des touches escape pour les modales
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeModal();
            }
        });
    }

    initAnimations() {
        // Animation d'apparition au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slideInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observer tous les éléments avec la classe 'animate-on-scroll'
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Animation des compteurs
        this.animateCounters();
    }

    animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            let current = 0;
            const increment = target / 50; // Animation en 50 étapes
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            // Démarrer l'animation quand l'élément est visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            observer.observe(counter);
        });
    }

    setupForms() {
        // Validation en temps réel des formulaires
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                input.addEventListener('blur', () => {
                    this.validateField(input);
                });
                
                input.addEventListener('input', () => {
                    this.clearFieldError(input);
                });
            });
            
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        const required = field.hasAttribute('required');
        
        // Supprimer les erreurs précédentes
        this.clearFieldError(field);
        
        if (required && !value) {
            this.showFieldError(field, 'Ce champ est requis');
            return false;
        }
        
        if (type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                this.showFieldError(field, 'Email invalide');
                return false;
            }
        }
        
        if (type === 'password' && value) {
            if (value.length < 6) {
                this.showFieldError(field, 'Le mot de passe doit contenir au moins 6 caractères');
                return false;
            }
        }
        
        return true;
    }

    validateForm(form) {
        const fields = form.querySelectorAll('input, textarea, select');
        let isValid = true;
        
        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    showFieldError(field, message) {
        field.classList.add('error');
        
        let errorElement = field.parentNode.querySelector('.field-error');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'field-error';
            field.parentNode.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
    }

    clearFieldError(field) {
        field.classList.remove('error');
        const errorElement = field.parentNode.querySelector('.field-error');
        if (errorElement) {
            errorElement.remove();
        }
    }

    setupSearch() {
        // Recherche en temps réel
        const searchInputs = document.querySelectorAll('.search-input');
        
        searchInputs.forEach(input => {
            input.addEventListener('input', () => {
                this.performSearch(input);
            });
        });

        // Filtres
        const filterSelects = document.querySelectorAll('.filter-select');
        
        filterSelects.forEach(select => {
            select.addEventListener('change', () => {
                this.applyFilters();
            });
        });
    }

    performSearch(input) {
        const query = input.value.toLowerCase();
        const targetSelector = input.dataset.target;
        const items = document.querySelectorAll(targetSelector);
        
        items.forEach(item => {
            const searchText = item.dataset.search || item.textContent;
            const matches = searchText.toLowerCase().includes(query);
            
            if (matches) {
                item.style.display = '';
                item.classList.remove('hidden');
            } else {
                item.style.display = 'none';
                item.classList.add('hidden');
            }
        });
        
        // Mettre à jour le compteur de résultats
        this.updateSearchResults(items, query);
    }

    applyFilters() {
        const filters = document.querySelectorAll('.filter-select');
        const items = document.querySelectorAll('.filterable-item');
        
        items.forEach(item => {
            let showItem = true;
            
            filters.forEach(filter => {
                const filterValue = filter.value;
                const filterType = filter.dataset.filter;
                
                if (filterValue && filterValue !== '') {
                    const itemValue = item.dataset[filterType];
                    if (itemValue !== filterValue) {
                        showItem = false;
                    }
                }
            });
            
            if (showItem) {
                item.style.display = '';
                item.classList.remove('hidden');
            } else {
                item.style.display = 'none';
                item.classList.add('hidden');
            }
        });
    }

    updateSearchResults(items, query) {
        const visibleItems = Array.from(items).filter(item => 
            !item.classList.contains('hidden') && item.style.display !== 'none'
        );
        
        const resultCounter = document.querySelector('.search-results-count');
        if (resultCounter) {
            if (query) {
                resultCounter.textContent = `${visibleItems.length} résultat(s) trouvé(s)`;
                resultCounter.style.display = 'block';
            } else {
                resultCounter.style.display = 'none';
            }
        }
    }

    setupFloatingShapes() {
        // Créer les formes flottantes de manière dynamique
        const shapesContainer = document.querySelector('.floating-shapes');
        
        if (shapesContainer) {
            // Nettoyer les formes existantes
            shapesContainer.innerHTML = '';
            
            // Créer de nouvelles formes
            const colors = ['#2563eb', '#ec4899', '#10b981', '#f97316'];
            const sizes = [60, 80, 100, 120];
            
            for (let i = 0; i < 4; i++) {
                const shape = document.createElement('div');
                shape.className = 'floating-shape animate-float';
                shape.style.cssText = `
                    width: ${sizes[i]}px;
                    height: ${sizes[i]}px;
                    background: ${colors[i]};
                    top: ${Math.random() * 80 + 10}%;
                    left: ${Math.random() * 80 + 10}%;
                    animation-delay: ${i * 3}s;
                `;
                
                shapesContainer.appendChild(shape);
            }
        }
    }

    // Méthodes utilitaires pour les modales
    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    closeModal() {
        const activeModal = document.querySelector('.modal.active');
        if (activeModal) {
            activeModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Notification toast
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animation d'apparition
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Fermeture automatique
        setTimeout(() => {
            this.hideNotification(notification);
        }, 5000);
        
        // Fermeture manuelle
        notification.querySelector('.notification-close').addEventListener('click', () => {
            this.hideNotification(notification);
        });
    }

    hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    // Méthodes utilitaires pour les agents
    initAgentInteraction() {
        const agentCards = document.querySelectorAll('.agent-card');
        
        agentCards.forEach(card => {
            card.addEventListener('click', (e) => {
                e.preventDefault();
                const agentType = card.dataset.agent;
                this.selectAgent(agentType);
            });
        });
    }

    selectAgent(agentType) {
        // Logique de sélection d'agent
        this.showNotification(`Agent ${agentType} sélectionné`, 'success');
        
        // Redirection vers la page de conversation
        setTimeout(() => {
            window.location.href = `?page=conversation&agent=${agentType}`;
        }, 1000);
    }

    // Gestion des thèmes
    initThemeToggle() {
        const themeToggle = document.querySelector('.theme-toggle');
        
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                this.toggleTheme();
            });
        }
        
        // Appliquer le thème sauvegardé
        this.applyTheme();
    }

    toggleTheme() {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        localStorage.setItem('theme', newTheme);
        this.applyTheme();
    }

    applyTheme() {
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    }

    // Gestion du loading
    showLoading() {
        const loader = document.querySelector('.loading-overlay') || this.createLoader();
        loader.style.display = 'flex';
    }

    hideLoading() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.style.display = 'none';
        }
    }

    createLoader() {
        const loader = document.createElement('div');
        loader.className = 'loading-overlay';
        loader.innerHTML = `
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>Chargement...</p>
            </div>
        `;
        document.body.appendChild(loader);
        return loader;
    }
}

// Initialisation quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    window.schoolAgent = new SchoolAgent();
});

// Fonctions utilitaires globales
window.SchoolAgentUtils = {
    // Formatage des dates
    formatDate: (date) => {
        return new Intl.DateTimeFormat('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }).format(new Date(date));
    },
    
    // Truncate text
    truncateText: (text, length = 100) => {
        return text.length > length ? text.substring(0, length) + '...' : text;
    },
    
    // Debounce function
    debounce: (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    // Generate random color
    getRandomColor: () => {
        const colors = ['#2563eb', '#ec4899', '#10b981', '#f97316', '#8b5cf6'];
        return colors[Math.floor(Math.random() * colors.length)];
    }
};