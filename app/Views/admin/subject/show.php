<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Matière: <?= htmlspecialchars($subject['nom']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $subject['id_matiere'] ?></li>
    <li><strong>Nom :</strong> <?= htmlspecialchars($subject['nom']) ?></li>
    <li><strong>Agent :</strong> <?= htmlspecialchars($subject['id_agent']) ?></li>
</ul>

<p>
    <a href="/admin/subject">⬅ Retour à la liste</a> |
    <a href="/admin/subject/edit?id=<?= $subject['id_matiere'] ?>">✏ Modifier</a> |
    <a href="/admin/subject/delete?id=<?= $subject['id_matiere'] ?>" onclick="return confirm('Supprimer cette matière ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
