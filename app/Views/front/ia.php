<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Assistant IA</title>
</head>
<body>

    <h1>Assistant IA</h1>

    <form method="post" action="/ia">
        <textarea name="prompt" rows="4" cols="50" placeholder="Pose ta question ici..."></textarea><br><br>
        <button type="submit">Envoyer</button>
    </form>

    <hr>

    <?php if (!empty($responseAI)) : ?>
        <h3>Réponse de l'IA :</h3>
        <div style="background:#f1f1f1;padding:15px;border-radius:5px;">
            <?= nl2br(htmlspecialchars($responseAI)); ?>
        </div>
    <?php endif; ?>

</body>
</html>
