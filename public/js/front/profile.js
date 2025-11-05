// School Agent - Profile Page JavaScript

/**
 * DOM Content Loaded Event Listener
 * Initializes all functionality when the page is fully loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initBurgerMenu();
    initFormValidation();
    initFlashMessageAnimation();
});

/**
 * Burger Menu Toggle
 * Handles the burger menu functionality
 */
function initBurgerMenu() {
    const burgerBtn = document.getElementById('burgerBtn');
    const burgerDropdown = document.getElementById('burgerDropdown');

    if (burgerBtn && burgerDropdown) {
        // Toggle dropdown on button click
        burgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            burgerDropdown.classList.toggle('show');
            burgerBtn.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.burger-menu')) {
                burgerDropdown.classList.remove('show');
                burgerBtn.classList.remove('active');
            }
        });

        // Close dropdown when clicking on a link
        const burgerItems = burgerDropdown.querySelectorAll('.burger-item');
        burgerItems.forEach(item => {
            item.addEventListener('click', () => {
                burgerDropdown.classList.remove('show');
                burgerBtn.classList.remove('active');
            });
        });
    }
}

/**
 * Form Validation
 * Validates profile edit and password change forms
 */
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Check if it's a password change form
            const changePasswordInput = form.querySelector('input[name="change_password"]');
            
            if (changePasswordInput) {
                // Validate password change form
                if (!validatePasswordForm(form)) {
                    e.preventDefault();
                    return false;
                }
            } else {
                // Validate profile edit form
                if (!validateProfileForm(form)) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    });
}

/**
 * Validate Profile Form
 * Ensures nom, prenom, and email are filled and valid
 */
function validateProfileForm(form) {
    const nom = form.querySelector('input[name="nom"]').value.trim();
    const prenom = form.querySelector('input[name="prenom"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();

    if (!nom) {
        showError('Le nom est requis');
        return false;
    }

    if (!prenom) {
        showError('Le prénom est requis');
        return false;
    }

    if (!email) {
        showError('L\'email est requis');
        return false;
    }

    if (!isValidEmail(email)) {
        showError('Veuillez entrer un email valide');
        return false;
    }

    return true;
}

/**
 * Validate Password Form
 * Ensures all password fields are filled and match
 */
function validatePasswordForm(form) {
    const currentPassword = form.querySelector('input[name="current_password"]').value;
    const newPassword = form.querySelector('input[name="new_password"]').value;
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value;

    if (!currentPassword) {
        showError('Le mot de passe actuel est requis');
        return false;
    }

    if (!newPassword) {
        showError('Le nouveau mot de passe est requis');
        return false;
    }

    if (newPassword.length < 6) {
        showError('Le nouveau mot de passe doit contenir au moins 6 caractères');
        return false;
    }

    if (newPassword !== confirmPassword) {
        showError('Les mots de passe ne correspondent pas');
        return false;
    }

    if (currentPassword === newPassword) {
        showError('Le nouveau mot de passe doit être différent du mot de passe actuel');
        return false;
    }

    return true;
}

/**
 * Email Validation
 * Checks if email format is valid
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Show Error Message
 * Displays a temporary error message to the user
 */
function showError(message) {
    // Remove existing error messages
    const existingError = document.querySelector('.flash-message.flash-error');
    if (existingError) {
        existingError.remove();
    }

    // Create new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'flash-message flash-error';
    errorDiv.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        ${message}
    `;

    // Insert at the top of the container
    const container = document.querySelector('.container');
    if (container) {
        container.insertBefore(errorDiv, container.firstChild);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            errorDiv.style.animation = 'slideDown 0.3s ease-out reverse';
            setTimeout(() => errorDiv.remove(), 300);
        }, 5000);
    }
}

/**
 * Flash Message Animation
 * Automatically hides flash messages after delay
 */
function initFlashMessageAnimation() {
    const flashMessages = document.querySelectorAll('.flash-message');
    
    flashMessages.forEach(message => {
        // Auto-hide after 5 seconds
        setTimeout(() => {
            message.style.animation = 'slideDown 0.3s ease-out reverse';
            setTimeout(() => {
                message.style.display = 'none';
            }, 300);
        }, 5000);
    });
}

/**
 * Export functions for potential module use
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initBurgerMenu,
        initFormValidation,
        initFlashMessageAnimation,
        validateProfileForm,
        validatePasswordForm,
        isValidEmail
    };
}
