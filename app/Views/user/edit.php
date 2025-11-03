<?php
// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ?page=login');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'email') {
        $new_email = $_POST['email'] ?? '';
        
        if (empty($new_email)) {
            $error = 'Veuillez entrer une adresse email.';
        } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $error = 'L\'adresse email est invalide.';
        } else {
            // Récupérer la connexion à la BD
            $db = \SchoolAgent\Config\Database::getConnection();
            
            try {
                $sql = 'UPDATE utilisateur SET email = ? WHERE id_user = ?';
                $stmt = $db->prepare($sql);
                
                if ($stmt->execute([$new_email, $_SESSION['user_id']])) {
                    $_SESSION['user_email'] = $new_email;
                    $success = 'Votre email a été modifié avec succès.';
                } else {
                    $error = 'Une erreur s\'est produite lors de la mise à jour.';
                }
            } catch (\PDOException $e) {
                $error = 'Erreur de base de données : ' . $e->getMessage();
            }
        }
    } elseif ($action === 'password') {
        $new_password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (empty($new_password)) {
            $error = 'Veuillez entrer un nouveau mot de passe.';
        } elseif ($new_password !== $confirm_password) {
            $error = 'Les mots de passe ne correspondent pas.';
        } elseif (strlen($new_password) < 6) {
            $error = 'Le mot de passe doit contenir au moins 6 caractères.';
        } else {
            // Récupérer la connexion à la BD
            $db = \SchoolAgent\Config\Database::getConnection();
            
            try {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $sql = 'UPDATE utilisateur SET mot_de_passe = ? WHERE id_user = ?';
                $stmt = $db->prepare($sql);
                
                if ($stmt->execute([$hashed_password, $_SESSION['user_id']])) {
                    $success = 'Votre mot de passe a été modifié avec succès.';
                } else {
                    $error = 'Une erreur s\'est produite lors de la mise à jour.';
                }
            } catch (\PDOException $e) {
                $error = 'Erreur de base de données : ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil - School Agent</title>
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
        
        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        .btn-glow {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.6);
            transform: translateY(-2px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-indigo-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="?page=home" class="flex items-center gap-3 group">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 p-2 rounded-lg">
                        <i class="fas fa-brain text-white text-lg"></i>
                    </div>
                    <span class="font-bold text-lg text-gray-900">School Agent</span>
                </a>
                
                <div class="flex items-center gap-4">
                    <a href="?page=user" class="text-gray-600 hover:text-indigo-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8 animate-slide-up">
            <h1 class="text-4xl font-bold mb-2 text-gray-900">Modifier mon profil</h1>
            <p class="text-lg text-gray-600">Mettez à jour votre email ou votre mot de passe</p>
        </div>

        <!-- Messages d'erreur et de succès -->
        <?php if ($error): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl animate-slide-up">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    <p class="text-red-700"><?php echo htmlspecialchars($error); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl animate-slide-up">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    <p class="text-green-700"><?php echo htmlspecialchars($success); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Card 1: Email -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-blue-100 mb-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <i class="fas fa-envelope text-blue-600"></i>Modifier mon Email
            </h2>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="action" value="email">
                
                <div>
                    <p class="text-sm text-gray-600 mb-3">
                        Email actuel : <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong>
                    </p>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Entrez votre nouvel email"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full btn-glow bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 rounded-lg hover:shadow-lg transition"
                >
                    <i class="fas fa-save mr-2"></i>Modifier l'email
                </button>
            </form>
        </div>

        <!-- Form Card 2: Password -->
        <div class="card-hover bg-white rounded-2xl shadow-lg p-8 border border-purple-100">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <i class="fas fa-lock text-purple-600"></i>Modifier mon Mot de Passe
            </h2>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="action" value="password">
                
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                        Nouveau Mot de Passe
                    </label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        placeholder="Minimum 6 caractères"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                    >
                </div>

                <div>
                    <label for="confirm_password" class="block text-sm font-semibold text-gray-900 mb-2">
                        Confirmer le Mot de Passe
                    </label>
                    <input 
                        type="password" 
                        id="confirm_password"
                        name="confirm_password" 
                        placeholder="Confirmez votre mot de passe"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full btn-glow bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold py-3 rounded-lg hover:shadow-lg transition"
                >
                    <i class="fas fa-save mr-2"></i>Modifier le mot de passe
                </button>
            </form>
        </div>

        <!-- Footer Help -->
        <div class="mt-8 text-center text-gray-600 text-sm">
            <p>Des problèmes ? <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold">Contactez le support</a></p>
        </div>
    </div>
</body>
</html>
