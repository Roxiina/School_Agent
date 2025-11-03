<?php
// Script pour générer toutes les Views adaptées au projet

$baseDir = __DIR__ . '/..';
$viewsDir = $baseDir . '/app/Views';

// HOME
$home = <<<'EOT'
<?php $pageTitle = 'Accueil - School Agent'; require __DIR__ . '/templates/header.php'; ?>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
    <h1><i class="fas fa-home"></i> Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?> !</h1>
    
    <div style="margin-top: 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 10px; cursor: pointer;" onclick="location.href='?page=conversation'">
            <i class="fas fa-comments" style="font-size: 2rem;"></i>
            <h3>Mes Conversations</h3>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Accéder à tes conversations</p>
        </div>

        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; border-radius: 10px; cursor: pointer;" onclick="location.href='?page=level'">
            <i class="fas fa-book" style="font-size: 2rem;"></i>
            <h3>Niveaux</h3>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Consulter les niveaux</p>
        </div>

        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; border-radius: 10px; cursor: pointer;" onclick="location.href='?page=subject'">
            <i class="fas fa-bookmark" style="font-size: 2rem;"></i>
            <h3>Matières</h3>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Explorer les matières</p>
        </div>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 3rem 0;">
        <h1><i class="fas fa-graduation-cap" style="font-size: 3rem; color: #667eea;"></i></h1>
        <h1>Bienvenue sur School Agent</h1>
        <p style="margin-top: 1rem; font-size: 1.1rem; color: #666;">Une plateforme d'apprentissage avec des agents IA</p>
        <a href="?page=login" class="btn btn-primary" style="margin-top: 1rem;"><i class="fas fa-sign-in-alt"></i> Se Connecter</a>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/home.php', $home);

// LOGIN
$login = <<<'EOT'
<?php $pageTitle = 'Connexion'; require __DIR__ . '/templates/header.php'; ?>

<h1><i class="fas fa-sign-in-alt"></i> Connexion</h1>

<div style="max-width: 400px; margin: 2rem auto;">
    <form method="POST">
        <div style="margin-bottom: 1rem;">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="mot_de_passe"><i class="fas fa-lock"></i> Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-sign-in-alt"></i> Se Connecter</button>
    </form>
</div>

<?php require __DIR__ . '/templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/auth/login.php', $login);

// CONVERSATION LIST
$convList = <<<'EOT'
<?php $pageTitle = 'Conversations'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-comments"></i> Mes Conversations</h1>

<div style="margin-bottom: 1rem;">
    <a href="?page=conversation&action=create" class="btn btn-primary"><i class="fas fa-plus"></i> Nouvelle Conversation</a>
</div>

<?php if (!empty($conversations)): ?>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #ddd;">Titre</th>
                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #ddd;">Agent</th>
                <th style="padding: 1rem; text-align: center; border-bottom: 2px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conversations as $conv): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 1rem;"><strong><?php echo htmlspecialchars($conv['titre']); ?></strong></td>
                    <td style="padding: 1rem;"><?php echo htmlspecialchars($conv['id_agent']); ?></td>
                    <td style="padding: 1rem; text-align: center;">
                        <a href="?page=conversation&action=show&id=<?php echo $conv['id_conversation']; ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;"><i class="fas fa-eye"></i> Voir</a>
                        <a href="?page=conversation&action=edit&id=<?php echo $conv['id_conversation']; ?>" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;"><i class="fas fa-edit"></i> Modifier</a>
                        <a href="?page=conversation&action=delete&id=<?php echo $conv['id_conversation']; ?>" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="return confirm('Êtes-vous sûr ?');"><i class="fas fa-trash"></i> Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 10px; color: #666;">
        <i class="fas fa-inbox" style="font-size: 2rem;"></i>
        <p style="margin-top: 1rem;">Aucune conversation pour le moment. <a href="?page=conversation&action=create">Créer une nouvelle</a></p>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/index.php', $convList);

// CONVERSATION SHOW
$convShow = <<<'EOT'
<?php $pageTitle = 'Conversation'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-chat"></i> <?php echo htmlspecialchars($conversation['titre'] ?? 'Conversation'); ?></h1>

<div style="margin-bottom: 1rem;">
    <a href="?page=conversation" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
    <a href="?page=conversation&action=edit&id=<?php echo $conversation['id_conversation']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Modifier</a>
</div>

<div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; max-height: 500px; overflow-y: auto;">
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div style="margin-bottom: 1rem; padding: 1rem; background: white; border-radius: 5px;">
                <strong><?php echo htmlspecialchars($msg['sender_type']); ?></strong>
                <p style="margin-top: 0.5rem;"><?php echo htmlspecialchars($msg['question'] ?? $msg['reponse'] ?? ''); ?></p>
                <small style="color: #999;">À vérifier l'affichage selon ta structure</small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; color: #999;">Aucun message dans cette conversation</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/show.php', $convShow);

// CONVERSATION CREATE
$convCreate = <<<'EOT'
<?php $pageTitle = 'Nouvelle Conversation'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-plus-circle"></i> Créer une Conversation</h1>

<form method="POST" style="max-width: 500px; margin: 2rem auto;">
    <div style="margin-bottom: 1rem;">
        <label for="title"><i class="fas fa-heading"></i> Titre</label>
        <input type="text" id="title" name="title" placeholder="Ex: Révision des équations" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 1rem;">
        <label for="agent_id"><i class="fas fa-robot"></i> Agent</label>
        <select id="agent_id" name="agent_id" style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="1">Agent Mathéo (Mathématiques)</option>
            <option value="2">Agent Histoire</option>
            <option value="3">Agent Scolaire</option>
        </select>
    </div>

    <div style="margin-bottom: 1rem;">
        <label for="subject_id"><i class="fas fa-bookmark"></i> Matière</label>
        <select id="subject_id" name="subject_id" style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="1">Mathématiques</option>
            <option value="2">Histoire</option>
            <option value="3">Méthodologie</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Créer</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/create.php', $convCreate);

// CONVERSATION EDIT
$convEdit = <<<'EOT'
<?php $pageTitle = 'Modifier Conversation'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-edit"></i> Modifier la Conversation</h1>

<form method="POST" style="max-width: 500px; margin: 2rem auto;">
    <div style="margin-bottom: 1rem;">
        <label for="title"><i class="fas fa-heading"></i> Titre</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($conversation['titre'] ?? ''); ?>" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-save"></i> Enregistrer</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/conversation/edit.php', $convEdit);

// LEVEL INDEX
$levelIndex = <<<'EOT'
<?php $pageTitle = 'Niveaux Scolaires'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-book"></i> Niveaux Scolaires</h1>

<?php if (!empty($levels)): ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
        <?php foreach ($levels as $level): ?>
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h3><i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($level['niveau'] ?? $level['name'] ?? ''); ?></h3>
                <a href="?page=level&action=show&id=<?php echo $level['id_niveau_scolaire'] ?? $level['id']; ?>" class="btn btn-primary" style="margin-top: 1rem; display: block; text-align: center;"><i class="fas fa-eye"></i> Voir</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p style="text-align: center; color: #999; margin-top: 2rem;">Aucun niveau disponible</p>
<?php endif; ?>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/level/index.php', $levelIndex);

// SUBJECT INDEX
$subjectIndex = <<<'EOT'
<?php $pageTitle = 'Matières'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-bookmark"></i> Matières</h1>

<?php if (!empty($subjects)): ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
        <?php foreach ($subjects as $subject): ?>
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <h3><i class="fas fa-bookmark"></i> <?php echo htmlspecialchars($subject['nom'] ?? $subject['name'] ?? ''); ?></h3>
                <a href="?page=subject&action=show&id=<?php echo $subject['id_matiere'] ?? $subject['id']; ?>" class="btn btn-primary" style="margin-top: 1rem; display: block; text-align: center;"><i class="fas fa-eye"></i> Voir</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p style="text-align: center; color: #999; margin-top: 2rem;">Aucune matière disponible</p>
<?php endif; ?>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/subject/index.php', $subjectIndex);

// USER PROFILE
$userProfile = <<<'EOT'
<?php $pageTitle = 'Mon Profil'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-user-circle"></i> Mon Profil</h1>

<div style="max-width: 500px; margin: 2rem auto; background: #f8f9fa; padding: 2rem; border-radius: 10px;">
    <p><strong><i class="fas fa-envelope"></i> Email :</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Non disponible'); ?></p>
    <p style="margin-top: 1rem;"><strong><i class="fas fa-user"></i> Nom :</strong> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Non disponible'); ?></p>
    <p style="margin-top: 1rem;"><strong><i class="fas fa-shield-alt"></i> Rôle :</strong> <?php echo htmlspecialchars($_SESSION['user_role'] ?? 'Utilisateur'); ?></p>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
EOT;

file_put_contents($viewsDir . '/user/show.php', $userProfile);

echo "Toutes les Views ont été générées avec succès !";
