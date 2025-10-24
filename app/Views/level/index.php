<h1>Liste des niveaux</h1>

<a href="/level/create">➕ Ajouter une matière</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Niveau</th><th>Action</th>
    </tr>
    <?php foreach ($levels as $level): ?>
    <tr>
        <td><?= $level['id_niveau_scolaire'] ?></td>
        <td><?= htmlspecialchars($level['niveau']) ?></td>
        <td>
            <a href="/level/edit?id=<?= $level['id_niveau_scolaire'] ?>">✏️</a>
            <a href="/level/delete?id=<?= $level['id_niveau_scolaire'] ?>" onclick="return confirm('Supprimer ce niveau ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
