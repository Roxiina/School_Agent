<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Conversations avec <?= htmlspecialchars($agent['nom']) ?></title>
</head>
<body>

    <a href="/ia">&larr; Retour au choix de l'assistant</a>

    <h1>Conversations avec "<?= htmlspecialchars($agent['nom']) ?>"</h1>

    <a href="/ia/chat?new_with_agent=<?= $agent['id_agent'] ?>" style="display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;">
        Nouvelle conversation
    </a>

    <hr>

    <h2>Historique des conversations</h2>

    <?php if (!empty($conversations)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($conversations as $conversation): ?>
                <li style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 10px; border-bottom: 1px solid #eee;">
                    <a href="/ia/chat?id=<?= $conversation['id_conversation'] ?>">
                        <?php
                            // Formatter la date pour l'affichage
                            $date = new DateTime($conversation['date_creation']);
                            echo 'Conversation du ' . $date->format('d-m-Y à H:i');
                        ?>
                    </a>
                    <form method="post" action="/ia/conversation/delete" style="margin: 0;">
                        <input type="hidden" name="conversation_id" value="<?= $conversation['id_conversation'] ?>">
                        <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?');" style="background: none; border: 1px solid #dc3545; color: #dc3545; border-radius: 5px; cursor: pointer; padding: 5px 10px;">
                            Supprimer
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun historique de conversation avec cet assistant.</p>
    <?php endif; ?>

</body>
</html>
