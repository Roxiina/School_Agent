<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
        }
        .btn-glow:hover::before {
            left: 100%;
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg border-b border-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="?page=home" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center group-hover:shadow-lg transition">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">School Agent</span>
                </a>
                
                <!-- Back Link -->
                <a href="?page=home" class="text-gray-700 hover:text-indigo-600 transition font-medium flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="animate-slide-up">
                <!-- Card Container -->
                <div class="bg-white/80 backdrop-blur-xl p-12 rounded-3xl shadow-2xl border border-indigo-100">
                    <!-- Header -->
                    <div class="text-center mb-10">
                        <div class="inline-block w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-lock text-white text-2xl"></i>
                        </div>
                        <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Connexion
                        </h1>
                        <p class="text-gray-600 text-lg">Bienvenue sur School Agent</p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="?page=login" class="space-y-6">
                        <!-- Email Field -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-900 mb-3">
                                <i class="fas fa-envelope text-indigo-600 mr-2"></i>Adresse Email
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                required 
                                class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:outline-none input-focus bg-gray-50 hover:bg-gray-100 transition font-medium" 
                                placeholder="votre@email.com"
                            >
                            <p class="text-xs text-gray-500 mt-2">Exemple: alice.dupont@example.com</p>
                        </div>

                        <!-- Password Field -->
                        <div class="group">
                            <label class="block text-sm font-bold text-gray-900 mb-3">
                                <i class="fas fa-key text-indigo-600 mr-2"></i>Mot de passe
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                required 
                                class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-600 focus:outline-none input-focus bg-gray-50 hover:bg-gray-100 transition font-medium" 
                                placeholder="Minimum 6 caractères"
                            >
                            <p class="text-xs text-gray-500 mt-2">Exemple: password1</p>
                        </div>

                        <!-- Error Message -->
                        <?php if (isset($error)): ?>
                            <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg">
                                <p class="text-red-700 font-semibold">
                                    <i class="fas fa-exclamation-circle mr-2"></i><?php echo htmlspecialchars($error); ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between pt-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" class="w-5 h-5 rounded border-2 border-indigo-600 accent-indigo-600">
                                <span class="text-sm text-gray-700 group-hover:text-indigo-600 transition">Se souvenir de moi</span>
                            </label>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition">
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl font-bold text-lg hover:shadow-2xl transition transform hover:scale-105 btn-glow mt-8"
                        >
                            <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center gap-4 my-8">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-gray-500 text-sm font-medium">OU</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <!-- Social Login (Optional) -->
                    <div class="grid grid-cols-2 gap-4">
                        <button class="border-2 border-gray-200 hover:border-indigo-600 text-gray-700 hover:text-indigo-600 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button class="border-2 border-gray-200 hover:border-indigo-600 text-gray-700 hover:text-indigo-600 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                            <i class="fab fa-github"></i> GitHub
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="mt-10 pt-6 border-t border-gray-200 text-center">
                        <p class="text-gray-700 font-medium">
                            Pas encore de compte ? 
                            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-bold transition">
                                S'inscrire gratuitement
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Test Credentials Info -->
                <div class="mt-8 bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg animate-fade-in">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-blue-900 mb-2">Compte de Test</h3>
                            <p class="text-sm text-blue-800 mb-1">
                                <strong>Email:</strong> alice.dupont@example.com
                            </p>
                            <p class="text-sm text-blue-800">
                                <strong>Mot de passe:</strong> password1
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Help Text -->
                <div class="mt-6 text-center text-gray-600 text-sm">
                    <p>Besoin d'aide ? 
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold transition">
                            Contactez le support
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 text-gray-300 border-t border-indigo-800/50 mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12 text-center">
            <p class="text-sm text-gray-400">&copy; 2024 School Agent. Tous droits réservés.</p>
            <p class="text-xs text-gray-500 mt-3">Développé avec ❤️ par Olivier / Nicolas / Flavie</p>
        </div>
    </footer>
</body>
</html>