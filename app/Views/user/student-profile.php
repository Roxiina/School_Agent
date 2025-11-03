<?php 
$title = "Mon Profil - School Agent";
use SchoolAgent\Config\Authenticator;
Authenticator::startSession();
$flash = Authenticator::getFlash();
$userName = Authenticator::getUserName();
$userRole = Authenticator::getUserRole();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #2c3e50;
        }
        
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }
        
        .btn-back {
            background: #64748b;
            color: white;
        }
        
        .btn-back:hover {
            background: #475569;
        }
        
        .main-content {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin: 0 auto 1.5rem;
        }
        
        .profile-name {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .profile-role {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        
        .role-etudiant {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .role-professeur {
            background: #d1fae5;
            color: #065f46;
        }
        
        .role-admin {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .form-group {
            margin-bottom: 2rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1rem;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-group input:disabled {
            background: #f1f5f9;
            color: #64748b;
            cursor: not-allowed;
        }
        
        .form-group input:disabled::placeholder {
            color: #cbd5e1;
        }
        
        .readonly-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #64748b;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }
        
        .help-text {
            font-size: 0.875rem;
            color: #64748b;
            margin-top: 0.5rem;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .btn-submit {
            background: #667eea;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background: #5a6fd8;
        }
        
        .btn-cancel {
            background: #e2e8f0;
            color: #2c3e50;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-cancel:hover {
            background: #cbd5e1;
        }
        
        .flash-message {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }
        
        .flash-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .flash-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="?" class="logo">🎓 School Agent</a>
            <div class="user-menu">
                <a href="?page=dashboard" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Retour au tableau de bord
                </a>
            </div>
        </div>
    </header>

    <!-- Message flash -->
    <?php if ($flash): ?>
        <div class="flash-message flash-<?= $flash['type'] ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- Contenu principal -->
    <main class="main-content">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h1 class="profile-name"><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h1>
                <span class="profile-role role-<?= htmlspecialchars($user['role']) ?>">
                    <?= htmlspecialchars($user['role']) ?>
                </span>
            </div>

            <?php if ($user['role'] === 'etudiant'): ?>
                <!-- Formulaire pour étudiant - email modifiable uniquement -->
                <form method="POST">
                    <div class="form-group">
                        <label for="prenom">
                            Prénom
                            <span class="readonly-badge">Lecture seule</span>
                        </label>
                        <input 
                            type="text" 
                            id="prenom" 
                            name="prenom" 
                            value="<?= htmlspecialchars($user['prenom']) ?>" 
                            disabled 
                            placeholder="Votre prénom"
                        />
                        <p class="help-text">Votre prénom ne peut pas être modifié</p>
                    </div>

                    <div class="form-group">
                        <label for="nom">
                            Nom
                            <span class="readonly-badge">Lecture seule</span>
                        </label>
                        <input 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            value="<?= htmlspecialchars($user['nom']) ?>" 
                            disabled 
                            placeholder="Votre nom"
                        />
                        <p class="help-text">Votre nom ne peut pas être modifié</p>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            Email
                            <span style="color: #10b981; font-weight: 600; font-size: 0.875rem;">✓ Modifiable</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?= htmlspecialchars($user['email']) ?>" 
                            required 
                            placeholder="Votre email"
                        />
                        <p class="help-text">Vous pouvez modifier votre adresse email</p>
                    </div>

                    <div class="form-group">
                        <label for="niveau">
                            Niveau Scolaire
                            <span class="readonly-badge">Lecture seule</span>
                        </label>
                        <input 
                            type="text" 
                            id="niveau" 
                            name="niveau" 
                            value="<?= htmlspecialchars($user['niveau'] ?? 'Non défini') ?>" 
                            disabled 
                            placeholder="Votre niveau"
                        />
                        <p class="help-text">Votre niveau ne peut pas être modifié</p>
                    </div>

                    <hr style="margin: 2rem 0; border: none; border-top: 2px solid #e2e8f0;">

                    <h3 style="color: #2c3e50; margin-bottom: 1.5rem; font-size: 1.25rem;">
                        <i class="fas fa-lock" style="color: #667eea; margin-right: 0.5rem;"></i>
                        Sécurité
                    </h3>

                    <div class="form-group">
                        <label for="password">
                            Nouveau mot de passe
                            <span style="color: #10b981; font-weight: 600; font-size: 0.875rem;">✓ Modifiable</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Laissez vide pour ne pas modifier"
                        />
                        <p class="help-text">Entrez un nouveau mot de passe si vous souhaitez le modifier. Minimum 8 caractères recommandés.</p>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">
                            Confirmer le mot de passe
                            <span style="color: #10b981; font-weight: 600; font-size: 0.875rem;">✓ Modifiable</span>
                        </label>
                        <input 
                            type="password" 
                            id="password_confirm" 
                            name="password_confirm" 
                            placeholder="Confirmez votre nouveau mot de passe"
                        />
                        <p class="help-text">Veuillez confirmer votre nouveau mot de passe</p>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i>
                            Enregistrer les modifications
                        </button>
                        <a href="?page=dashboard" class="btn-cancel">
                            <i class="fas fa-times"></i>
                            Annuler
                        </a>
                    </div>
                </form>
            <?php else: ?>
                <!-- Profil complet pour prof/admin -->
                <div style="display: grid; gap: 1.5rem;">
                    <div style="padding: 1rem; background: #f8fafc; border-radius: 8px;">
                        <span style="display: block; color: #64748b; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Prénom</span>
                        <span style="color: #2c3e50; font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($user['prenom']) ?></span>
                    </div>
                    <div style="padding: 1rem; background: #f8fafc; border-radius: 8px;">
                        <span style="display: block; color: #64748b; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Nom</span>
                        <span style="color: #2c3e50; font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($user['nom']) ?></span>
                    </div>
                    <div style="padding: 1rem; background: #f8fafc; border-radius: 8px;">
                        <span style="display: block; color: #64748b; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Email</span>
                        <span style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; word-break: break-all;"><?= htmlspecialchars($user['email']) ?></span>
                    </div>
                    <div style="padding: 1rem; background: #f8fafc; border-radius: 8px;">
                        <span style="display: block; color: #64748b; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Rôle</span>
                        <span class="profile-role role-<?= htmlspecialchars($user['role']) ?>">
                            <?= htmlspecialchars($user['role']) ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // Masquer automatiquement les messages flash après 5 secondes
        setTimeout(() => {
            const flashMessage = document.querySelector('.flash-message');
            if (flashMessage) {
                flashMessage.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => flashMessage.remove(), 300);
            }
        }, 5000);
    </script>
</body>
</html>