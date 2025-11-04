// School Agent - Login Page JavaScript

/**
 * DOM Content Loaded Event Listener
 * Initializes all functionality when the page is fully loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initFormValidation();
    initLoadingStates();
    initAnimations();
    initFormFocus();
});

/**
 * Form validation functionality
 */
function initFormValidation() {
    const form = document.querySelector('.login-form');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="mot_de_passe"]');
    const submitButton = document.querySelector('button[type="submit"]');

    if (!form || !emailInput || !passwordInput || !submitButton) return;

    // Real-time email validation
    emailInput.addEventListener('input', function() {
        validateEmail(this);
    });

    // Real-time password validation
    passwordInput.addEventListener('input', function() {
        validatePassword(this);
    });

    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate email
        if (!validateEmail(emailInput)) {
            isValid = false;
        }

        // Validate password
        if (!validatePassword(passwordInput)) {
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            showError('Veuillez corriger les erreurs dans le formulaire.');
            return;
        }

        // Show loading state
        showLoadingState(submitButton);
    });
}

/**
 * Email validation
 */
function validateEmail(input) {
    const email = input.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email === '') {
        setFieldError(input, 'L\'email est requis.');
        return false;
    }
    
    if (!emailRegex.test(email)) {
        setFieldError(input, 'Veuillez entrer une adresse email valide.');
        return false;
    }
    
    setFieldSuccess(input);
    return true;
}

/**
 * Password validation
 */
function validatePassword(input) {
    const password = input.value;
    
    if (password === '') {
        setFieldError(input, 'Le mot de passe est requis.');
        return false;
    }
    
    if (password.length < 6) {
        setFieldError(input, 'Le mot de passe doit contenir au moins 6 caractères.');
        return false;
    }
    
    setFieldSuccess(input);
    return true;
}

/**
 * Set field error state
 */
function setFieldError(input, message) {
    const formGroup = input.closest('.form-group');
    if (!formGroup) return;

    // Remove existing error
    const existingError = formGroup.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }

    // Add error class
    input.classList.add('error');
    input.classList.remove('success');

    // Add error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.cssText = `
        color: var(--danger);
        font-size: var(--font-size-sm);
        margin-top: var(--spacing-1);
        display: flex;
        align-items: center;
        gap: var(--spacing-1);
    `;
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
    
    formGroup.appendChild(errorDiv);

    // Update input border color
    input.style.borderColor = 'var(--danger)';
}

/**
 * Set field success state
 */
function setFieldSuccess(input) {
    const formGroup = input.closest('.form-group');
    if (!formGroup) return;

    // Remove existing error
    const existingError = formGroup.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }

    // Add success class
    input.classList.add('success');
    input.classList.remove('error');

    // Update input border color
    input.style.borderColor = 'var(--accent)';
}

/**
 * Show error message
 */
function showError(message) {
    // Remove existing error messages
    const existingErrors = document.querySelectorAll('.temp-error');
    existingErrors.forEach(error => error.remove());

    // Create new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'flash-message flash-error temp-error animate-fade-in';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;

    // Insert before form
    const form = document.querySelector('.login-form');
    if (form) {
        form.parentNode.insertBefore(errorDiv, form);
    }

    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (errorDiv.parentNode) {
            errorDiv.remove();
        }
    }, 5000);
}

/**
 * Loading states for form submission
 */
function initLoadingStates() {
    const form = document.querySelector('.login-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
            showLoadingState(submitButton);
        }
    });
}

/**
 * Show loading state on button
 */
function showLoadingState(button) {
    button.classList.add('loading');
    button.disabled = true;
    
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion en cours...';
    
    // Reset after 10 seconds if no response
    setTimeout(() => {
        if (button.classList.contains('loading')) {
            button.classList.remove('loading');
            button.disabled = false;
            button.innerHTML = originalText;
        }
    }, 10000);
}

/**
 * Initialize animations
 */
function initAnimations() {
    // Animate login container on load
    const loginContainer = document.querySelector('.login-container');
    if (loginContainer) {
        loginContainer.classList.add('animate-fade-in');
    }

    // Animate form elements with delay
    const formElements = document.querySelectorAll('.form-group, .btn, .login-links');
    formElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate-fade-in');
        }, 200 + (index * 100));
    });
}

/**
 * Initialize form focus effects
 */
function initFormFocus() {
    const inputs = document.querySelectorAll('.form-input');
    
    inputs.forEach(input => {
        // Add focus class to parent on focus
        input.addEventListener('focus', function() {
            const formGroup = this.closest('.form-group');
            if (formGroup) {
                formGroup.classList.add('focused');
            }
        });

        // Remove focus class on blur
        input.addEventListener('blur', function() {
            const formGroup = this.closest('.form-group');
            if (formGroup) {
                formGroup.classList.remove('focused');
            }
        });

        // Add floating label effect
        input.addEventListener('input', function() {
            const formGroup = this.closest('.form-group');
            if (formGroup) {
                if (this.value.trim() !== '') {
                    formGroup.classList.add('filled');
                } else {
                    formGroup.classList.remove('filled');
                }
            }
        });
    });
}

/**
 * Auto-dismiss flash messages
 */
function initFlashMessages() {
    const flashMessages = document.querySelectorAll('.flash-message:not(.temp-error)');
    
    flashMessages.forEach(message => {
        // Add close button
        const closeButton = document.createElement('button');
        closeButton.innerHTML = '<i class="fas fa-times"></i>';
        closeButton.style.cssText = `
            background: none;
            border: none;
            color: currentColor;
            opacity: 0.7;
            cursor: pointer;
            padding: 0;
            margin-left: auto;
            font-size: var(--font-size-sm);
        `;
        
        closeButton.addEventListener('click', () => {
            message.remove();
        });
        
        message.appendChild(closeButton);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (message.parentNode) {
                message.style.opacity = '0';
                setTimeout(() => {
                    message.remove();
                }, 300);
            }
        }, 5000);
    });
}

/**
 * Keyboard shortcuts
 */
function initKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Enter key submits form when focused on inputs
        if (e.key === 'Enter' && e.target.matches('.form-input')) {
            const form = e.target.closest('form');
            if (form) {
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton && !submitButton.disabled) {
                    submitButton.click();
                }
            }
        }
        
        // Escape key clears form
        if (e.key === 'Escape') {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.value = '';
                input.style.borderColor = '';
                input.classList.remove('error', 'success');
            });
            
            // Remove error messages
            const errors = document.querySelectorAll('.field-error');
            errors.forEach(error => error.remove());
        }
    });
}

// Initialize additional features
document.addEventListener('DOMContentLoaded', function() {
    initFlashMessages();
    initKeyboardShortcuts();
});

/**
 * Utility functions
 */
function debounce(func, wait) {
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

/**
 * Export functions for potential module use
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        validateEmail,
        validatePassword,
        showLoadingState,
        showError
    };
}