<h1>Liste des messages</h1>

<a href="/message/create">➕ Ajouter un message</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Message</th><th>Actions</th>
    </tr>
    <?php foreach ($messages as $message): ?>
    <tr>
        <td><?= $message['id_message'] ?></td>
        <td><?= htmlspecialchars($message['question']) ?></td>
        <td>
            <a href="/message/show?id=<?= $message['id_message'] ?>">👁️</a> 
            <a href="/message/edit?id=<?= $message['id_message'] ?>">✏️</a>
            <a href="/message/delete?id=<?= $message['id_message'] ?>" onclick="return confirm('Supprimer ce message ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/home" class="btn btn-outline-secondary">← Retour à l’accueil</a>
