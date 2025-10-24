<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Niveau Scolaire <?= htmlspecialchars($level['niveau']) ?></h1>

<ul>
    <li><strong>ID :</strong> <?= $level['id_niveau_scolaire'] ?></li>
    <li><strong>Niveau Scolaire :</strong> <?= htmlspecialchars($level['niveau']) ?></li>
</ul>

<p>
    <a href="/level">⬅ Retour à la liste</a> |
    <a href="/level/edit?id=<?= $level['id_niveau_scolaire'] ?>">✏ Modifier</a> |
    <a href="/level/delete?id=<?= $level['id_niveau_scolaire'] ?>" onclick="return confirm('Supprimer ce niveau ?')">🗑 Supprimer</a>
</p>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
