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
        
        .profile-info {
            display: grid;
            gap: 1.5rem;
        }
        
        .info-group {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            border-radius: 8px;
            background: #f8fafc;
        }
        
        .info-label {
            font-weight: 600;
            color: #64748b;
        }
        
        .info-value {
            color: #2c3e50;
        }
        
        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .btn-edit {
            background: #667eea;
            color: white;
        }
        
        .btn-edit:hover {
            background: #5a6fd8;
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

            <div class="profile-info">
                <div class="info-group">
                    <span class="info-label">Email :</span>
                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Prénom :</span>
                    <span class="info-value"><?= htmlspecialchars($user['prenom']) ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Nom :</span>
                    <span class="info-value"><?= htmlspecialchars($user['nom']) ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Rôle :</span>
                    <span class="info-value">
                        <span class="profile-role role-<?= htmlspecialchars($user['role']) ?>">
                            <?= htmlspecialchars($user['role']) ?>
                        </span>
                    </span>
                </div>
                
                <?php if (isset($user['niveau'])): ?>
                <div class="info-group">
                    <span class="info-label">Niveau scolaire :</span>
                    <span class="info-value"><?= htmlspecialchars($user['niveau']) ?></span>
                </div>
                <?php endif; ?>
                
                <div class="info-group">
                    <span class="info-label">Membre depuis :</span>
                    <span class="info-value">
                        <?= isset($user['date_creation']) ? date('d/m/Y', strtotime($user['date_creation'])) : 'N/A' ?>
                    </span>
                </div>
            </div>

            <div class="actions">
                <a href="?page=user&action=edit&id=<?= $user['id_user'] ?>" class="btn btn-edit">
                    <i class="fas fa-edit"></i>
                    Modifier mon profil
                </a>
            </div>
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