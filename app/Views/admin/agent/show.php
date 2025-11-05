<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Agent #<?= $agent['id_agent'] ?> : <?= htmlspecialchars($agent['nom']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $agent['id_agent'] ?></li>
    <li><strong>Nom :</strong> <?= htmlspecialchars($agent['nom']) ?></li>
    <li><strong>Description :</strong><?= nl2br(htmlspecialchars($agent['description'])) ?></li>
    <li><strong>Température :</strong> <?= $agent['temperature'] ?></li>
    <li><strong>System prompt :</strong><br><?= nl2br(htmlspecialchars($agent['system_prompt'])) ?></li>
    <li><strong>Modèle :</strong> <?= htmlspecialchars($agent['model']) ?></li>
    <li><strong>Max tokens :</strong> <?= $agent['max_completion_tokens'] ?></li>
</ul>

<p>
    <a href="/admin/agent">⬅ Retour</a> |
    <a href="/admin/agent/edit?id=<?= $agent['id_agent'] ?>">✏ Modifier</a> |
    <a href="/admin/agent/delete?id=<?= $agent['id_agent'] ?>" onclick="return confirm('Supprimer cet agent ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
