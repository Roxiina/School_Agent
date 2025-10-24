<h1>Liste des matières</h1>

<a href="/subject/create">➕ Ajouter une matière</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Nom</th><th>Actions</th>
    </tr>
    <?php foreach ($subjects as $subject): ?>
    <tr>
        <td><?= $subject['id_matiere'] ?></td>
        <td><?= htmlspecialchars($subject['nom']) ?></td>
        <td>
            <a href="/subject/edit?id=<?= $subject['id_matiere'] ?>">✏️</a>
            <a href="/subject/delete?id=<?= $subject['id_matiere'] ?>" onclick="return confirm('Supprimer cette matière ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
