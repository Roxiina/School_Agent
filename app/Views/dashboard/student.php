<?php 
$title = "Tableau de bord Étudiant - School Agent";
use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;
use SchoolAgent\Models\ConversationModel;
use SchoolAgent\Models\SubjectModel;

Authenticator::startSession();
$flash = Authenticator::getFlash();
$userName = Authenticator::getUserName();
$userId = Authenticator::getUserId();

// Récupérer les données de l'utilisateur
$userModel = new UserModel();
$user = $userModel->getUser($userId);

// Récupérer les conversations de l'étudiant
$conversationModel = new ConversationModel();
$conversations = $conversationModel->getConversationsByUser($userId);

// Récupérer le nombre de conversations par agent
$conversationsByAgent = $conversationModel->getConversationCountByAgent($userId);

// Récupérer les matières avec agents
$subjectModel = new SubjectModel();
$subjects = $subjectModel->getSubjectsWithAgents();
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
        
        .welcome-text {
            color: #64748b;
            font-weight: 500;
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
        
        .btn-logout {
            background: #ef4444;
            color: white;
        }
        
        .btn-logout:hover {
            background: #dc2626;
        }
        
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        
        .card p {
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .card-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .card-link:hover {
            color: #5a6fd8;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-top: 0.5rem;
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
                <span class="welcome-text">Bonjour, <?= htmlspecialchars($userName) ?></span>
                <a href="?page=logout" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
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
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 2rem; text-align: center;">
            Tableau de bord Étudiant
        </h1>

        <!-- Statistiques -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= count($subjects) ?></div>
                <div class="stat-label">Matières disponibles</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($conversations) ?></div>
                <div class="stat-label">Conversations actives</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $user['niveau'] ?? 'N/A' ?></div>
                <div class="stat-label">Niveau scolaire</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= isset($user['date_creation']) ? date('d/m/Y', strtotime($user['date_creation'])) : 'Actif' ?></div>
                <div class="stat-label">Membre depuis</div>
            </div>
        </div>

        <!-- Section Mon Profil -->
        <section style="background: white; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-user-circle" style="color: #667eea;"></i>
                Mon Profil
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
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
                    <span style="display: block; color: #64748b; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Niveau Scolaire</span>
                    <span style="color: #2c3e50; font-size: 1.1rem; font-weight: 500;"><?= htmlspecialchars($user['niveau'] ?? 'Non défini') ?></span>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <a href="?page=profile" class="btn btn-primary" style="color: white; background: #667eea; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-edit"></i>
                    Modifier mon profil
                </a>
            </div>
        </section>

        <!-- Section Mes Conversations -->
        <section style="background: white; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-comments" style="color: #667eea;"></i>
                Mes Conversations (<?= count($conversations) ?>)
            </h2>
            <div style="margin-bottom: 1.5rem;">
                <a href="?page=conversation/chat" class="btn" style="color: white; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer;">
                    <i class="fas fa-comments"></i>
                    💬 Ouvrir le chat
                </a>
            </div>
            <?php if (count($conversations) > 0): ?>
                <div style="display: grid; gap: 1rem;">
                    <?php foreach ($conversations as $conv): ?>
                        <div style="padding: 1.5rem; background: #f8fafc; border-radius: 8px; border-left: 4px solid #667eea; transition: all 0.3s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: start; gap: 1rem;">
                                <div style="flex: 1;">
                                    <h4 style="color: #2c3e50; margin-bottom: 0.5rem; font-size: 1.1rem;">
                                        <?= htmlspecialchars($conv['titre']) ?>
                                    </h4>
                                    <p style="color: #64748b; font-size: 0.875rem; margin-bottom: 0.5rem;">
                                        <i class="fas fa-robot" style="color: #667eea;"></i>
                                        Agent : <strong><?= htmlspecialchars($conv['agent_nom']) ?></strong>
                                    </p>
                                    <p style="color: #64748b; font-size: 0.875rem;">
                                        <i class="fas fa-calendar" style="color: #667eea;"></i>
                                        <?= date('d/m/Y à H:i', strtotime($conv['date_creation'])) ?>
                                    </p>
                                </div>
                                <a href="?page=conversation/chat&id=<?= $conv['id_conversation'] ?>" style="color: #667eea; text-decoration: none; font-weight: 600; white-space: nowrap;">
                                    Voir <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem; background: #f8fafc; border-radius: 8px;">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                    <p style="color: #64748b;">Vous n'avez pas encore de conversations. Commencez une discussion avec un agent !</p>
                </div>
            <?php endif; ?>
        </section>

        <!-- Section Agents par Matière -->
        <section style="background: white; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-book" style="color: #667eea;"></i>
                Agents par Matière (<?= count($subjects) ?>)
            </h2>
            <?php if (count($subjects) > 0): ?>
                <div class="dashboard-grid">
                    <?php foreach ($subjects as $subject): 
                        // Trouver le nombre de conversations avec cet agent
                        $convCount = 0;
                        foreach ($conversationsByAgent as $agentConv) {
                            if ($agentConv['id_agent'] == $subject['id_agent']) {
                                $convCount = $agentConv['conversation_count'];
                                break;
                            }
                        }
                    ?>
                        <div class="card">
                            <div class="card-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3><?= htmlspecialchars($subject['matiere_nom']) ?></h3>
                            <p style="color: #64748b; margin-bottom: 0.75rem;">
                                <strong style="color: #2c3e50;">Agent :</strong> <?= htmlspecialchars($subject['agent_nom']) ?>
                            </p>
                            <p style="color: #667eea; font-weight: 600; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-comments"></i>
                                <span><?= $convCount ?> conversation<?= $convCount > 1 ? 's' : '' ?></span>
                            </p>
                            <p style="color: #64748b; font-size: 0.875rem; line-height: 1.5; margin-bottom: 1rem;">
                                <?= htmlspecialchars(substr($subject['description'], 0, 100)) ?>...
                            </p>
                            <a href="?page=conversation&action=create&agent_id=<?= $subject['id_agent'] ?>&subject_id=<?= $subject['id_matiere'] ?>" class="card-link">
                                Commencer une conversation <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 2rem; background: #f8fafc; border-radius: 8px;">
                    <p style="color: #64748b;">Aucune matière disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </section>
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