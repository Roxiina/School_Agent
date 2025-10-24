<h1>Liste des niveaux</h1>

<a href="/level/create">➕ Ajouter un niveau</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Niveau</th><th>Action</th>
    </tr>
    <?php foreach ($levels as $level): ?>
    <tr>
        <td><?= $level['id_niveau_scolaire'] ?></td>
        <td><?= htmlspecialchars($level['niveau']) ?></td>
        <td>
            <a href="/level/show?id=<?= $level['id_niveau_scolaire'] ?>">👁️</a>
            <a href="/level/edit?id=<?= $level['id_niveau_scolaire'] ?>">✏️</a>
            <a href="/level/delete?id=<?= $level['id_niveau_scolaire'] ?>" onclick="return confirm('Supprimer ce niveau ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="/home" class="btn btn-outline-secondary">← Retour à l’accueil</a>
