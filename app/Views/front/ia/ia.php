<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir un Assistant IA</title>
</head>
<body>

    <h1>Choisir un Assistant IA</h1>

    <p>Sélectionnez l'assistant avec lequel vous souhaitez converser :</p>

    <?php if (!empty($agents)): ?>
        <ul>
            <?php foreach ($agents as $agent): ?>
                <li>
                    <a href="/ia/conversations?id=<?= $agent['id_agent'] ?>">
                        <?= htmlspecialchars($agent['nom']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun assistant ne vous est assigné pour le moment.</p>
    <?php endif; ?>

</body>
</html>
