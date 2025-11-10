<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Modifier l'agent : <?= htmlspecialchars($agent['nom']) ?></h1>

<form action="/admin/agent/edit?id=<?= $agent['id_agent'] ?>" method="POST">
    <input type="text" name="nom" value="<?= htmlspecialchars($agent['nom']) ?>" required><br>
    <input type="text" name="avatar" value="<?= htmlspecialchars($agent['avatar']) ?>"><br>
    <textarea name="description"><?= htmlspecialchars($agent['description']) ?></textarea><br>
    <input type="number" step="0.1" name="temperature" value="<?= $agent['temperature'] ?>"><br>
    <textarea name="system_prompt"><?= htmlspecialchars($agent['system_prompt']) ?></textarea><br>
    <input type="text" name="model" value="<?= htmlspecialchars($agent['model']) ?>" required><br>
    <input type="number" name="max_completion_tokens" value="<?= $agent['max_completion_tokens'] ?>" required><br>

    <button type="submit">💾 Modifier</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
