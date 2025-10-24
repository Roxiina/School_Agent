<h1>Liste des conversations</h1>

<a href="/conversation/create">➕ Ajouter une conversation</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Converstation</th><th>Action</th>
    </tr>
    <?php foreach ($conversations as $conversation): ?>
    <tr>
        <td><?= $conversation['id_conversation'] ?></td>
        <td><?= htmlspecialchars($conversation['titre']) ?></td>
        <td>
            <a href="/conversation/show?id=<?= $conversation['id_conversation'] ?>">👁️</a>
            <a href="/conversation/edit?id=<?= $conversation['id_conversation'] ?>">✏️</a>
            <a href="/conversation/delete?id=<?= $conversation['id_conversation'] ?>" onclick="return confirm('Supprimer cette conversation (ATTENTION CASCADE) ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/home" class="btn btn-outline-secondary">← Retour à l’accueil</a>
