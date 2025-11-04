/**
 * SCHOOL AGENT - ADMIN JAVASCRIPT FRAMEWORK
 * Framework JavaScript pour l'interface d'administration
 */

class SchoolAgentAdmin {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeModals();
        this.initializeNotifications();
        this.initializeTableSorting();
        this.initializeFormValidation();
        this.initializeSearch();
        this.initializeStats();
        this.setupTheme();
    }

    // === GESTION DES ÉVÉNEMENTS === //
    setupEventListeners() {
        document.addEventListener('DOMContentLoaded', () => {
            this.initPage();
        });

        // Gestion des boutons de suppression
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('admin-btn-delete')) {
                this.handleDelete(e);
            }
        });

        // Gestion des boutons de modal
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('admin-modal-trigger')) {
                this.openModal(e.target.dataset.modal);
            }
            if (e.target.classList.contains('admin-modal-close')) {
                this.closeModal();
            }
        });

        // Fermeture modal avec échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && document.querySelector('.admin-modal.active')) {
                this.closeModal();
            }
        });
    }

    // === GESTION DES MODALES === //
    initializeModals() {
        this.activeModal = null;
    }

    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            modal.style.display = 'flex';
            this.activeModal = modal;
            document.body.style.overflow = 'hidden';
            
            // Animation d'ouverture
            setTimeout(() => {
                modal.querySelector('.admin-modal-content').style.transform = 'scale(1)';
                modal.querySelector('.admin-modal-content').style.opacity = '1';
            }, 10);
        }
    }

    closeModal() {
        if (this.activeModal) {
            const content = this.activeModal.querySelector('.admin-modal-content');
            content.style.transform = 'scale(0.95)';
            content.style.opacity = '0';
            
            setTimeout(() => {
                this.activeModal.style.display = 'none';
                this.activeModal.classList.remove('active');
                this.activeModal = null;
                document.body.style.overflow = '';
            }, 200);
        }
    }

    // === SYSTÈME DE NOTIFICATIONS === //
    initializeNotifications() {
        this.notifications = [];
    }

    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `admin-notification admin-notification-${type}`;
        
        const icon = this.getNotificationIcon(type);
        notification.innerHTML = `
            <div class="admin-notification-content">
                <i class="${icon}"></i>
                <span>${message}</span>
            </div>
            <button class="admin-notification-close">
                <i class="fas fa-times"></i>
            </button>
        `;

        // Container de notifications
        let container = document.querySelector('.admin-notifications-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'admin-notifications-container';
            document.body.appendChild(container);
        }

        container.appendChild(notification);
        this.notifications.push(notification);

        // Animation d'apparition
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Fermeture automatique
        if (duration > 0) {
            setTimeout(() => {
                this.removeNotification(notification);
            }, duration);
        }

        // Bouton de fermeture
        notification.querySelector('.admin-notification-close').addEventListener('click', () => {
            this.removeNotification(notification);
        });
    }

    getNotificationIcon(type) {
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        return icons[type] || icons.info;
    }

    removeNotification(notification) {
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
            this.notifications = this.notifications.filter(n => n !== notification);
        }, 300);
    }

    // === TRI DES TABLEAUX === //
    initializeTableSorting() {
        document.querySelectorAll('.admin-table th[data-sort]').forEach(header => {
            header.style.cursor = 'pointer';
            header.innerHTML += ' <i class="fas fa-sort admin-sort-icon"></i>';
            
            header.addEventListener('click', () => {
                this.sortTable(header);
            });
        });
    }

    sortTable(header) {
        const table = header.closest('.admin-table');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const columnIndex = Array.from(header.parentNode.children).indexOf(header);
        const sortType = header.dataset.sort;
        const isAscending = !header.classList.contains('sort-asc');

        // Reset autres headers
        header.parentNode.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
            const icon = th.querySelector('.admin-sort-icon');
            if (icon) icon.className = 'fas fa-sort admin-sort-icon';
        });

        // Tri des lignes
        rows.sort((a, b) => {
            const aValue = a.children[columnIndex].textContent.trim();
            const bValue = b.children[columnIndex].textContent.trim();

            let comparison = 0;
            if (sortType === 'number') {
                comparison = parseFloat(aValue) - parseFloat(bValue);
            } else if (sortType === 'date') {
                comparison = new Date(aValue) - new Date(bValue);
            } else {
                comparison = aValue.localeCompare(bValue);
            }

            return isAscending ? comparison : -comparison;
        });

        // Mise à jour du tableau
        rows.forEach(row => tbody.appendChild(row));

        // Mise à jour de l'icône
        header.classList.add(isAscending ? 'sort-asc' : 'sort-desc');
        const icon = header.querySelector('.admin-sort-icon');
        icon.className = `fas fa-sort-${isAscending ? 'up' : 'down'} admin-sort-icon`;
    }

    // === VALIDATION DES FORMULAIRES === //
    initializeFormValidation() {
        document.querySelectorAll('.admin-form').forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                }
            });

            // Validation en temps réel
            form.querySelectorAll('.admin-form-input').forEach(input => {
                input.addEventListener('blur', () => {
                    this.validateField(input);
                });
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('.admin-form-input[required]');

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(input) {
        const value = input.value.trim();
        const type = input.type;
        let isValid = true;
        let message = '';

        // Suppression des erreurs précédentes
        this.clearFieldError(input);

        // Validation requis
        if (input.hasAttribute('required') && !value) {
            isValid = false;
            message = 'Ce champ est requis';
        }
        // Validation email
        else if (type === 'email' && value && !this.isValidEmail(value)) {
            isValid = false;
            message = 'Format d\'email invalide';
        }
        // Validation mot de passe
        else if (type === 'password' && value && value.length < 6) {
            isValid = false;
            message = 'Le mot de passe doit contenir au moins 6 caractères';
        }

        if (!isValid) {
            this.showFieldError(input, message);
        }

        return isValid;
    }

    showFieldError(input, message) {
        input.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'admin-field-error';
        errorDiv.textContent = message;
        input.parentNode.appendChild(errorDiv);
    }

    clearFieldError(input) {
        input.classList.remove('error');
        const existingError = input.parentNode.querySelector('.admin-field-error');
        if (existingError) {
            existingError.remove();
        }
    }

    isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // === FONCTION DE RECHERCHE === //
    initializeSearch() {
        const searchInputs = document.querySelectorAll('.admin-search-input');
        
        searchInputs.forEach(input => {
            let timeout;
            input.addEventListener('input', (e) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    this.performSearch(e.target.value, e.target.dataset.target);
                }, 300);
            });
        });
    }

    performSearch(query, targetSelector) {
        const target = document.querySelector(targetSelector);
        if (!target) return;

        const items = target.querySelectorAll('[data-searchable]');
        
        items.forEach(item => {
            const searchText = item.dataset.searchable.toLowerCase();
            const queryLower = query.toLowerCase();
            
            if (searchText.includes(queryLower)) {
                item.style.display = '';
                item.classList.add('search-match');
            } else {
                item.style.display = 'none';
                item.classList.remove('search-match');
            }
        });

        // Affichage du résultat
        const visibleItems = target.querySelectorAll('[data-searchable]:not([style*="display: none"])');
        this.updateSearchResults(visibleItems.length, query);
    }

    updateSearchResults(count, query) {
        const resultElement = document.querySelector('.admin-search-results');
        if (resultElement) {
            if (query.trim()) {
                resultElement.textContent = `${count} résultat${count > 1 ? 's' : ''} pour "${query}"`;
                resultElement.style.display = 'block';
            } else {
                resultElement.style.display = 'none';
            }
        }
    }

    // === STATISTIQUES ANIMÉES === //
    initializeStats() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateCounter(entry.target);
                }
            });
        });

        document.querySelectorAll('.admin-stat-number').forEach(stat => {
            observer.observe(stat);
        });
    }

    animateCounter(element) {
        const target = parseInt(element.dataset.count || element.textContent);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 16);
    }

    // === GESTION DU THÈME === //
    setupTheme() {
        // Thème admin rouge par défaut
        document.documentElement.setAttribute('data-theme', 'admin-red');
        
        // Sauvegarde du thème admin
        localStorage.setItem('school-agent-admin-theme', 'admin-red');
    }

    // === GESTION DES SUPPRESSIONS === //
    handleDelete(e) {
        e.preventDefault();
        
        const itemName = e.target.dataset.itemName || 'cet élément';
        const deleteUrl = e.target.dataset.deleteUrl || e.target.href;
        
        this.showConfirmDialog(
            'Confirmer la suppression',
            `Êtes-vous sûr de vouloir supprimer ${itemName} ?`,
            () => {
                this.performDelete(deleteUrl, itemName);
            }
        );
    }

    showConfirmDialog(title, message, onConfirm) {
        const modal = document.createElement('div');
        modal.className = 'admin-modal active';
        modal.innerHTML = `
            <div class="admin-modal-content">
                <div class="admin-modal-header">
                    <h3 class="admin-modal-title">${title}</h3>
                </div>
                <div class="admin-modal-body">
                    <p class="admin-mb-6">${message}</p>
                    <div class="admin-flex admin-gap-4 admin-justify-center">
                        <button class="admin-btn admin-btn-secondary admin-modal-cancel">
                            Annuler
                        </button>
                        <button class="admin-btn admin-btn-error admin-modal-confirm">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        // Gestionnaires d'événements
        modal.querySelector('.admin-modal-cancel').addEventListener('click', () => {
            document.body.removeChild(modal);
            document.body.style.overflow = '';
        });

        modal.querySelector('.admin-modal-confirm').addEventListener('click', () => {
            document.body.removeChild(modal);
            document.body.style.overflow = '';
            onConfirm();
        });
    }

    performDelete(url, itemName) {
        // Affichage du loader
        this.showLoader('Suppression en cours...');

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            this.hideLoader();
            
            if (data.success) {
                this.showNotification(`${itemName} supprimé avec succès`, 'success');
                // Rechargement de la page après 1 seconde
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                this.showNotification(data.message || 'Erreur lors de la suppression', 'error');
            }
        })
        .catch(error => {
            this.hideLoader();
            this.showNotification('Erreur réseau lors de la suppression', 'error');
            console.error('Erreur:', error);
        });
    }

    // === LOADER === //
    showLoader(message = 'Chargement...') {
        const loader = document.createElement('div');
        loader.className = 'admin-loader';
        loader.innerHTML = `
            <div class="admin-loader-content">
                <div class="admin-spinner"></div>
                <p>${message}</p>
            </div>
        `;
        document.body.appendChild(loader);
    }

    hideLoader() {
        const loader = document.querySelector('.admin-loader');
        if (loader) {
            document.body.removeChild(loader);
        }
    }

    // === INITIALISATION DE PAGE === //
    initPage() {
        // Animation des éléments
        document.querySelectorAll('.admin-animate-fade-in').forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Mise à jour de l'heure
        this.updateClock();
        setInterval(() => this.updateClock(), 60000);
    }

    updateClock() {
        const clockElement = document.querySelector('.admin-clock');
        if (clockElement) {
            const now = new Date();
            const timeString = now.toLocaleTimeString('fr-FR', {
                hour: '2-digit',
                minute: '2-digit'
            });
            clockElement.textContent = timeString;
        }
    }
}

// Initialisation globale
window.SchoolAgentAdmin = SchoolAgentAdmin;

// Démarrage automatique
document.addEventListener('DOMContentLoaded', () => {
    window.adminApp = new SchoolAgentAdmin();
});

// === STYLES CSS ADDITIONNELS POUR JS === //
const additionalStyles = `
<style>
/* Notifications */
.admin-notifications-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    pointer-events: none;
}

.admin-notification {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    margin-bottom: var(--spacing-3);
    padding: var(--spacing-4);
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-width: 300px;
    pointer-events: all;
    transform: translateX(100%);
    opacity: 0;
    transition: all 0.3s ease;
}

.admin-notification.show {
    transform: translateX(0);
    opacity: 1;
}

.admin-notification.hide {
    transform: translateX(100%);
    opacity: 0;
}

.admin-notification-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-3);
}

.admin-notification-success {
    border-left: 4px solid var(--admin-success);
}

.admin-notification-error {
    border-left: 4px solid var(--admin-error);
}

.admin-notification-warning {
    border-left: 4px solid var(--admin-warning);
}

.admin-notification-info {
    border-left: 4px solid var(--admin-primary);
}

.admin-notification-close {
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: var(--spacing-1);
    border-radius: var(--radius);
    transition: all 0.3s ease;
}

.admin-notification-close:hover {
    background: var(--gray-100);
    color: var(--gray-600);
}

/* Loader */
.admin-loader {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 200;
}

.admin-loader-content {
    background: white;
    padding: var(--spacing-8);
    border-radius: var(--radius-xl);
    text-align: center;
    box-shadow: var(--shadow-xl);
}

.admin-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--gray-200);
    border-top: 4px solid var(--admin-primary);
    border-radius: 50%;
    animation: admin-spin 1s linear infinite;
    margin: 0 auto var(--spacing-4);
}

/* Erreurs de champs */
.admin-form-input.error {
    border-color: var(--admin-error);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.admin-field-error {
    color: var(--admin-error);
    font-size: var(--font-size-sm);
    margin-top: var(--spacing-1);
}

/* Tri de tableau */
.admin-table th.sort-asc .admin-sort-icon {
    color: var(--admin-primary);
}

.admin-table th.sort-desc .admin-sort-icon {
    color: var(--admin-primary);
}
</style>
`;

// Injection des styles
document.head.insertAdjacentHTML('beforeend', additionalStyles);