<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chat avec <?= htmlspecialchars($agent['nom']) ?></title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; }
        .chat-container { max-width: 800px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; border-radius: 8px; background-color: #fff; }
        .message { margin-bottom: 15px; padding: 10px 15px; border-radius: 18px; max-width: 80%; line-height: 1.4; }
        .user-message { background-color: #007bff; color: white; margin-left: auto; text-align: left; }
        .ai-message { background-color: #e9e9eb; color: #333; margin-right: auto; text-align: left; }
        .message p { margin: 0; }
        .message .author { font-weight: bold; margin-bottom: 5px; font-size: 0.8em; opacity: 0.8; }
        textarea { width: 100%; box-sizing: border-box; padding: 10px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 10px; }
        button { width: 100%; padding: 10px 20px; border: none; background-color: #007bff; color: white; border-radius: 8px; cursor: pointer; font-size: 1em; }
        button:hover { background-color: #0056b3; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="chat-container">
        <p><a href="/ia/conversations?id=<?= $agent['id_agent'] ?>">&larr; Retour à l'historique de "<?= htmlspecialchars($agent['nom']) ?>"</a></p>
        <h1 style="text-align: center;"><?= htmlspecialchars($conversation['titre']) ?></h1>
        <hr>

        <div class="messages-history">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message user-message">
                        <p class="author">Vous</p>
                        <p><?= nl2br(htmlspecialchars($message['question'])) ?></p>
                    </div>
                    <?php if (!empty($message['reponse'])): ?>
                        <div class="message ai-message">
                            <p class="author"><?= htmlspecialchars($agent['nom']) ?></p>
                            <p><?= nl2br(htmlspecialchars($message['reponse'])) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center;">C'est le début de votre conversation. Posez votre première question !</p>
            <?php endif; ?>
        </div>

        <hr>

        <form method="post" action="">
            <?php if ($isNew ?? false): ?>
                <input type="hidden" name="agent_id" value="<?= $agent['id_agent'] ?>">
            <?php endif; ?>
            <textarea name="prompt" rows="4" placeholder="Votre message..." required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>

</body>
</html>
