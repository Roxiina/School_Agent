<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>La matière: <?= htmlspecialchars($subject['id_matiere']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $subject['id_matiere'] ?></li>
    <li><strong>Matière :</strong> <?= htmlspecialchars($subject['nom']) ?></li>
</ul>

<p>
    <a href="/subject">⬅ Retour à la liste</a> |
    <a href="/subject/edit?id=<?= $subject['id_matiere'] ?>">✏ Modifier</a> |
    <a href="/subject/delete?id=<?= $subject['id_matiere'] ?>" onclick="return confirm('Supprimer cette matière ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>