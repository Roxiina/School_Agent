<h1>Liste des utilisateurs</h1>

<a href="/user/create">➕ Ajouter un utilisateur</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Rôle</th><th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id_user'] ?></td>
        <td><?= htmlspecialchars($user['nom']) ?></td>
        <td><?= htmlspecialchars($user['prenom']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td>
            <a href="/user/show?id=<?= $user['id_user'] ?>">👁️</a>    
            <a href="/user/edit?id=<?= $user['id_user'] ?>">✏️</a>
            <a href="/user/delete?id=<?= $user['id_user'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/home" class="btn btn-outline-secondary">← Retour à l’accueil</a>
