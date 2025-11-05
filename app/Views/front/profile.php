<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - School Agent</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/css/front/dashboard.css">
    
    <style>
        .profile-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%);
            padding: var(--spacing-16) var(--spacing-6);
            color: white;
            text-align: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-5xl);
            margin: 0 auto var(--spacing-6);
            border: 3px solid white;
        }

        .profile-header h1 {
            font-size: var(--font-size-4xl);
            margin-bottom: var(--spacing-1);
        }

        .profile-header p {
            opacity: 0.9;
            font-size: var(--font-size-sm);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .profile-body {
            padding: var(--spacing-12);
        }

        .info-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-6);
            margin-bottom: var(--spacing-12);
            padding-bottom: var(--spacing-12);
            border-bottom: 1px solid var(--gray-200);
        }

        .info-item {
            padding: var(--spacing-4);
            background: var(--gray-50);
            border-radius: var(--radius);
            border-left: 4px solid var(--primary);
        }

        .info-item-label {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            text-transform: uppercase;
            margin-bottom: var(--spacing-2);
            letter-spacing: 0.5px;
        }

        .info-item-value {
            font-size: var(--font-size-lg);
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-separator {
            margin: var(--spacing-16) 0;
            border-top: 2px solid var(--gray-200);
        }

        .form-group {
            margin-bottom: var(--spacing-6);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-2);
            font-weight: 600;
            color: var(--text-primary);
            font-size: var(--font-size-sm);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: var(--spacing-3) var(--spacing-4);
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: var(--font-size-base);
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-actions {
            display: flex;
            gap: var(--spacing-3);
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .info-group {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .profile-header h1 {
                font-size: var(--font-size-2xl);
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="/home" class="logo">
                <i class="fas fa-graduation-cap"></i>
                School Agent
            </a>
            <div class="nav-right">
                <a href="/home">← Retour à l'accueil</a>
                <div class="burger-menu">
                    <button class="burger-btn" id="burgerBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="burger-dropdown" id="burgerDropdown">
                        <a href="/profile" class="burger-item active">
                            <i class="fas fa-user-circle"></i> Mon Profil
                        </a>
                        <a href="/dashboard/agents" class="burger-item">
                            <i class="fas fa-brain"></i> Suivi des Agents
                        </a>
                        <a href="/dashboard/conversations" class="burger-item">
                            <i class="fas fa-comments"></i> Historique des Conversations
                        </a>
                        <hr style="margin: 10px 0; border: none; border-top: 1px solid var(--gray-200);">
                        <a href="/logout" class="burger-item logout">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Container -->
    <div class="container">
        <a href="/home" class="back-btn">
            <i class="fas fa-arrow-left"></i> Retour à l'accueil
        </a>

        <!-- Flash Messages -->
        <?php if (isset($flash) && $flash): ?>
            <div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>">
                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h1><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h1>
                <p><?= htmlspecialchars(ucfirst($user['role'])) ?></p>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <!-- Info Section -->
                <div class="info-group">
                    <div class="info-item">
                        <div class="info-item-label">Email</div>
                        <div class="info-item-value"><?= htmlspecialchars($user['email']) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-item-label">Rôle</div>
                        <div class="info-item-value"><?= htmlspecialchars(ucfirst($user['role'])) ?></div>
                    </div>
                </div>

                <!-- Edit Form -->
                <form action="/profile/update" method="POST">
                    <h2 style="font-size: var(--font-size-2xl); font-weight: 700; color: var(--text-primary); margin-bottom: var(--spacing-8); display: flex; align-items: center; gap: var(--spacing-3);">
                        <i class="fas fa-edit"></i> Modifier Mon Profil
                    </h2>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="form-actions">
                        <a href="/home" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Sauvegarder
                        </button>
                    </div>
                </form>

                <!-- Separator -->
                <div class="form-separator"></div>

                <!-- Change Password Form -->
                <form action="/profile/update" method="POST">
                    <h2 style="font-size: var(--font-size-2xl); font-weight: 700; color: var(--text-primary); margin-bottom: var(--spacing-8); display: flex; align-items: center; gap: var(--spacing-3);">
                        <i class="fas fa-key"></i> Changer Mon Mot de Passe
                    </h2>

                    <input type="hidden" name="change_password" value="1">

                    <div class="form-group">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmer le mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="form-actions">
                        <a href="/home" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/front/profile.js"></script>
</body>
</html>
