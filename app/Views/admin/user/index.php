<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Gestion des utilisateurs</h1>

<p><a href="/admin/user/create">➕ Ajouter un utilisateur</a></p>

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
    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= $u['id_user'] ?></td>
        <td><?= htmlspecialchars($u['nom']) ?></td>
        <td><?= htmlspecialchars($u['prenom']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['role']) ?></td>
        <td><?= htmlspecialchars($u['niveau']) ?></td>
        <td>
            <a href="/admin/user/show?id=<?= $u['id_user'] ?>">👁️</a>
            <a href="/admin/user/edit?id=<?= $u['id_user'] ?>">✏️</a>
            <a href="/admin/user/delete?id=<?= $u['id_user'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
