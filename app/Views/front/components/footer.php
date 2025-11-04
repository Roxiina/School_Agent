<!-- FOOTER COMPONENT -->
<footer class="bg-white border-t-2 border-gray-100">
    <div class="container py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo et description -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-blue rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-blue bg-clip-text text-transparent">School Agent</span>
                </div>
                <p class="text-gray-600 mb-4">
                    Plateforme éducative interactive avec des agents IA spécialisés pour vous accompagner dans votre apprentissage.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Navigation -->
            <div>
                <h3 class="font-bold text-gray-900 mb-4">Navigation</h3>
                <ul class="space-y-2">
                    <li><a href="/home" class="text-gray-600 hover:text-blue-600 transition">Accueil</a></li>
                    <li><a href="/subjects" class="text-gray-600 hover:text-blue-600 transition">Matières</a></li>
                    <li><a href="/levels" class="text-gray-600 hover:text-blue-600 transition">Niveaux</a></li>
                    <li><a href="/conversations" class="text-gray-600 hover:text-blue-600 transition">Conversations</a></li>
                </ul>
            </div>
            
            <!-- Agents IA -->
            <div>
                <h3 class="font-bold text-gray-900 mb-4">Nos Agents IA</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/agent/matheo" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                            <i class="fas fa-calculator text-blue-500"></i>
                            Agent Mathéo
                        </a>
                    </li>
                    <li>
                        <a href="/agent/histoire" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                            <i class="fas fa-landmark text-orange-500"></i>
                            Agent Histoire
                        </a>
                    </li>
                    <li>
                        <a href="/agent/scolaire" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-green-500"></i>
                            Agent Scolaire
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="font-bold text-gray-900 mb-4">Contact</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-envelope text-blue-500"></i>
                        contact@schoolagent.fr
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-phone text-blue-500"></i>
                        +33 1 23 45 67 89
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                        123 Rue de l'Éducation, Paris
                    </li>
                </ul>
                
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-900 mb-2">Newsletter</h4>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Votre email" class="form-input flex-1 text-sm">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-600 text-sm">
                © 2025 School Agent. Tous droits réservés.
            </p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="?page=privacy" class="text-gray-600 hover:text-blue-600 transition text-sm">Confidentialité</a>
                <a href="?page=terms" class="text-gray-600 hover:text-blue-600 transition text-sm">Conditions d'utilisation</a>
                <a href="?page=cookies" class="text-gray-600 hover:text-blue-600 transition text-sm">Cookies</a>
            </div>
        </div>
    </div>
</footer>