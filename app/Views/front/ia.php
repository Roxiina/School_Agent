<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>IA Assistant</title>
</head>
<body>

    <h1>Assistant IA</h1>

    <form method="post" action="/ia">
        <label for="agent_id">Choisis un agent :</label>
        <select name="agent_id" id="agent_id" required>
            <?php foreach ($agents as $agent): ?>
                <?php $selected = (isset($_POST['agent_id']) && $_POST['agent_id'] == $agent['id_agent']) ? 'selected' : ''; ?>
                <option value="<?= $agent['id_agent'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($agent['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <textarea name="prompt" rows="4" cols="50" placeholder="Pose ta question ici..." required><?= htmlspecialchars($_POST['prompt'] ?? '') ?></textarea>
        <br><br>

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
