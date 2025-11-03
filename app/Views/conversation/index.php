<?php
// Démarrer la session
\SchoolAgent\Config\Authenticator::startSession();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ?page=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations - School Agent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #ffffff;
        }
        .sidebar {
            background-color: #f7f7f7;
            border-right: 1px solid #e5e5e5;
        }
        .chat-message {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .user-message {
            background-color: #10a37f;
            color: white;
            border-radius: 18px;
            padding: 12px 16px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .assistant-message {
            background-color: #f7f7f7;
            color: #333;
            border-radius: 18px;
            padding: 12px 16px;
            max-width: 80%;
            word-wrap: break-word;
            border: 1px solid #e5e5e5;
        }
        .conversation-item {
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
            border: 1px solid transparent;
        }
        .conversation-item:hover {
            background-color: #e5e5e5;
        }
        .conversation-item.active {
            background-color: #d3d3d3;
            border: 1px solid #bbb;
        }
        input[type="text"]::placeholder {
            color: #999;
        }
    </style>
</head>
<body class="bg-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 flex flex-col border-r border-gray-200">
            <!-- Header Sidebar -->
            <div class="p-4 border-b border-gray-200">
                <button class="w-full flex items-center gap-3 px-4 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition font-semibold text-gray-700">
                    <i class="fas fa-plus"></i> Nouvelle conversation
                </button>
            </div>

            <!-- Conversations List -->
            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                <div class="conversation-item active" data-id="1">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Ouvrir le chat</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Dernier message reçu...</p>
                        </div>
                    </div>
                </div>

                <div class="conversation-item" data-id="2">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Révision des équations</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Peux-tu m'aider avec les...</p>
                        </div>
                    </div>
                </div>

                <div class="conversation-item" data-id="3">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Guerre mondiale</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Quels étaient les causes...</p>
                        </div>
                    </div>
                </div>

                <div class="conversation-item" data-id="4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Physique chimie</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Comment fonctionne le...</p>
                        </div>
                    </div>
                </div>

                <div class="conversation-item" data-id="5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Littérature française</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Analyse de Victor Hugo...</p>
                        </div>
                    </div>
                </div>

                <div class="conversation-item" data-id="6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">Géographie mondiale</p>
                            <p class="text-xs text-gray-600 mt-1 truncate">Capitales des pays...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-200">
                <a href="?page=home" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-home text-lg"></i>
                    <span class="text-sm font-semibold">Accueil</span>
                </a>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white">
            <!-- Chat Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-robot text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Agent Scolaire</h2>
                        <p class="text-sm text-gray-500">En ligne</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600">
                        <i class="fas fa-info-circle text-lg"></i>
                    </button>
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition text-gray-600">
                        <i class="fas fa-ellipsis-v text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-white">
                <!-- Assistant Message -->
                <div class="chat-message flex justify-start">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="assistant-message">
                            <p>Bonjour ! 👋 Je suis votre assistant scolaire. Comment puis-je vous aider aujourd'hui ?</p>
                        </div>
                    </div>
                </div>

                <!-- User Message -->
                <div class="chat-message flex justify-end">
                    <div class="user-message">
                        <p>Peux-tu m'expliquer les équations du second degré ?</p>
                    </div>
                </div>

                <!-- Assistant Message -->
                <div class="chat-message flex justify-start">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="assistant-message max-w-2xl">
                            <p>Bien sûr ! Une équation du second degré est une équation de la forme :</p>
                            <p class="mt-2 font-mono bg-gray-900 text-green-400 p-3 rounded mt-3">ax² + bx + c = 0</p>
                            <p class="mt-3">Où a, b et c sont des constantes et a ≠ 0.</p>
                            <p class="mt-2">Pour résoudre cette équation, on utilise la formule :</p>
                        </div>
                    </div>
                </div>

                <!-- User Message -->
                <div class="chat-message flex justify-end">
                    <div class="user-message">
                        <p>Et comment on trouve les solutions ?</p>
                    </div>
                </div>

                <!-- Assistant Message -->
                <div class="chat-message flex justify-start">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="assistant-message max-w-2xl">
                            <p>On utilise le discriminant (Δ) :</p>
                            <p class="mt-2 font-mono bg-gray-900 text-green-400 p-3 rounded">Δ = b² - 4ac</p>
                            <p class="mt-3">Ensuite selon la valeur de Δ :</p>
                            <ul class="mt-2 ml-4 space-y-1">
                                <li>• Si Δ > 0 : deux solutions réelles</li>
                                <li>• Si Δ = 0 : une solution double</li>
                                <li>• Si Δ < 0 : pas de solution réelle</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex gap-3">
                    <input 
                        type="text" 
                        placeholder="Envoyer un message..." 
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600"
                    >
                    <button class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition font-semibold">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.conversation-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>