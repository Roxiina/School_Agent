<?php
use SchoolAgent\Config\Authenticator;

Authenticator::startSession();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'School Agent'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="?page=home" class="flex items-center gap-2 text-2xl font-bold text-indigo-600">
                <i class="fas fa-graduation-cap"></i>
                <span>School Agent</span>
            </a>
            
            <div class="flex items-center gap-6">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <a href="?page=conversation" class="hover:text-indigo-600 transition">
                        <i class="fas fa-comments"></i> Conversations
                    </a>
                    <a href="?page=level" class="hover:text-indigo-600 transition">
                        <i class="fas fa-book"></i> Niveaux
                    </a>
                    <a href="?page=subject" class="hover:text-indigo-600 transition">
                        <i class="fas fa-bookmark"></i> Matières
                    </a>
                    <div class="flex items-center gap-3 pl-6 border-l border-gray-300">
                        <span class="text-sm text-gray-700">
                            <i class="fas fa-user-circle"></i> 
                            <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?>
                        </span>
                        <a href="?page=logout" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                <?php else: ?>
                    <a href="?page=login" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Alerts -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-lg p-8">
