<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - School Agent</title>
    <meta name="description" content="Connectez-vous à votre compte School Agent pour accéder à vos agents IA éducatifs">
    
    <!-- CSS Framework -->
    <link rel="stylesheet" href="/app/front/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-light min-h-screen flex items-center justify-center">
    
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element" style="top: 10%; left: 10%; animation-delay: 0s;">
            <i class="fas fa-graduation-cap text-blue-200 text-6xl opacity-20"></i>
        </div>
        <div class="floating-element" style="top: 20%; right: 15%; animation-delay: 2s;">
            <i class="fas fa-book text-purple-200 text-5xl opacity-20"></i>
        </div>
        <div class="floating-element" style="bottom: 20%; left: 20%; animation-delay: 1s;">
            <i class="fas fa-lightbulb text-yellow-200 text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Login Container -->
    <div class="container mx-auto px-6 py-12 relative z-10">
        <div class="max-w-md mx-auto">
            
            <!-- Back to Home -->
            <div class="text-center mb-8">
                <a href="/home" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à l'accueil
                </a>
            </div>

            <!-- Login Card -->
            <div class="card animate-on-scroll">
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-blue rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-3xl"></i>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Connexion
                    </h1>
                    
                    <p class="text-gray-600">
                        Accédez à votre compte School Agent
                    </p>
                </div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-6" method="POST" action="/app/controllers/AuthController.php">
                    <input type="hidden" name="action" value="login">
                    
                    <!-- Error Messages -->
                    <div id="errorMessages" class="alert alert-error" style="display: none;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span id="errorText">Une erreur est survenue</span>
                    </div>

                    <!-- Success Messages -->
                    <div id="successMessage" class="alert alert-success" style="display: none;">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="successText">Connexion réussie !</span>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope mr-2"></i>
                            Adresse email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="votre@email.com"
                            required
                            autocomplete="email"
                        >
                        <div class="form-error" id="emailError"></div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock mr-2"></i>
                            Mot de passe
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input pr-12" 
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="form-error" id="passwordError"></div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        
                        <a href="/forgot-password" class="text-sm text-blue-600 hover:text-blue-800 transition">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-full btn-glow" id="loginButton">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Se connecter
                    </button>

                    <!-- Loading State -->
                    <button type="button" class="btn btn-primary w-full" id="loginLoading" style="display: none;" disabled>
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Connexion en cours...
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-4 text-gray-500">Ou</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600 mb-4">
                        Vous n'avez pas encore de compte ?
                    </p>
                    
                    <a href="/register" class="btn btn-outline w-full">
                        <i class="fas fa-user-plus mr-2"></i>
                        Créer un compte
                    </a>
                </div>

                <!-- Admin Access -->
                <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-2">
                            Accès administrateur
                        </p>
                        <a href="/admin" class="text-sm text-blue-600 hover:text-blue-800 transition font-medium">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Connexion admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Demo Access -->
            <div class="text-center mt-6">
                <a href="/demo" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition">
                    <i class="fas fa-play mr-2"></i>
                    Essayer la démonstration
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="/app/front/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const app = new SchoolAgent();
            app.init();
            
            // Login form handling
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const loginLoading = document.getElementById('loginLoading');
            const errorMessages = document.getElementById('errorMessages');
            const successMessage = document.getElementById('successMessage');
            
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
            
            // Form validation
            const validateForm = () => {
                let isValid = true;
                
                // Email validation
                const email = document.getElementById('email');
                const emailError = document.getElementById('emailError');
                if (!email.value.trim()) {
                    emailError.textContent = 'L\'adresse email est requise';
                    emailError.style.display = 'block';
                    isValid = false;
                } else if (!isValidEmail(email.value)) {
                    emailError.textContent = 'Veuillez saisir une adresse email valide';
                    emailError.style.display = 'block';
                    isValid = false;
                } else {
                    emailError.style.display = 'none';
                }
                
                // Password validation
                const password = document.getElementById('password');
                const passwordError = document.getElementById('passwordError');
                if (!password.value.trim()) {
                    passwordError.textContent = 'Le mot de passe est requis';
                    passwordError.style.display = 'block';
                    isValid = false;
                } else {
                    passwordError.style.display = 'none';
                }
                
                return isValid;
            };
            
            const isValidEmail = (email) => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            };
            
            // Form submission
            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!validateForm()) {
                    return;
                }
                
                // Show loading state
                loginButton.style.display = 'none';
                loginLoading.style.display = 'block';
                errorMessages.style.display = 'none';
                successMessage.style.display = 'none';
                
                try {
                    const formData = new FormData(loginForm);
                    
                    const response = await fetch('/app/controllers/AuthController.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Show success message
                        document.getElementById('successText').textContent = result.message || 'Connexion réussie !';
                        successMessage.style.display = 'block';
                        
                        // Redirect after delay
                        setTimeout(() => {
                            if (result.redirect) {
                                window.location.href = result.redirect;
                            } else {
                                window.location.href = '?page=dashboard';
                            }
                        }, 1500);
                    } else {
                        // Show error message
                        document.getElementById('errorText').textContent = result.message || 'Identifiants incorrects';
                        errorMessages.style.display = 'block';
                        
                        // Reset form state
                        loginButton.style.display = 'block';
                        loginLoading.style.display = 'none';
                    }
                } catch (error) {
                    console.error('Erreur lors de la connexion:', error);
                    
                    // Show generic error
                    document.getElementById('errorText').textContent = 'Une erreur technique est survenue. Veuillez réessayer.';
                    errorMessages.style.display = 'block';
                    
                    // Reset form state
                    loginButton.style.display = 'block';
                    loginLoading.style.display = 'none';
                }
            });
            
            // Real-time validation
            document.getElementById('email').addEventListener('blur', validateForm);
            document.getElementById('password').addEventListener('blur', validateForm);
            
            // Clear errors on input
            document.getElementById('email').addEventListener('input', function() {
                document.getElementById('emailError').style.display = 'none';
                errorMessages.style.display = 'none';
            });
            
            document.getElementById('password').addEventListener('input', function() {
                document.getElementById('passwordError').style.display = 'none';
                errorMessages.style.display = 'none';
            });
            
            // Auto-focus first field
            document.getElementById('email').focus();
            
            // Handle URL parameters for pre-filling or error display
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            const email = urlParams.get('email');
            
            if (error) {
                document.getElementById('errorText').textContent = decodeURIComponent(error);
                errorMessages.style.display = 'block';
            }
            
            if (email) {
                document.getElementById('email').value = decodeURIComponent(email);
            }
        });
    </script>
</body>
</html>