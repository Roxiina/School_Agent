<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1>Liste des utilisateurs</h1>

<p><a href="/user/create">➕ Ajouter un utilisateur</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Niveau</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id_user'] ?></td>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['prenom']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td><?= htmlspecialchars($user['niveau']) ?></td>
        <td>
            <a href="/user/show?id=<?= $user['id_user'] ?>">👁️</a>    
            <a href="/user/edit?id=<?= $user['id_user'] ?>">✏️</a>
            <a href="/user/delete?id=<?= $user['id_user'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>