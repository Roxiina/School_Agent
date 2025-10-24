<h1>Profil de <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h1>


<?php
// Démarre la session si elle ne l'est pas déjà
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Dump de debug
echo "<pre style='background:#222;color:#0f0;padding:10px;border-radius:5px;'>";
echo "=== DEBUG SESSION ===\n";
var_dump($_SESSION);
echo "</pre>";
?>


<ul>
    <li><strong>ID :</strong> <?= $user['id_user'] ?></li>
    <li><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></li>
    <li><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></li>
    <li><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></li>
    <li><strong>Rôle :</strong> <?= htmlspecialchars($user['role']) ?></li>
    <li><strong>Niveau scolaire :</strong> <?= htmlspecialchars($user['id_niveau_scolaire']) ?></li>
</ul>

<p>
    <a href="/user">⬅ Retour à la liste</a> |
    <a href="/user/edit?id=<?= $user['id_user'] ?>">✏ Modifier</a> |
    <a href="/user/delete?id=<?= $user['id_user'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑 Supprimer</a>
</p>
