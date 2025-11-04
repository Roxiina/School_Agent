<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>✏️ Modifier la relation utilisateur-agent</h1>

<p><a href="/admin/useragent">⬅️ Retour à la liste</a></p>

<form action="" method="post">
    <p>
        <strong>Utilisateur :</strong>
        <?= htmlspecialchars($relation['user_nom'] . ' ' . $relation['user_prenom']) ?>
    </p>

    <p>
        <label for="id_agent">Agent :</label>
        <select name="id_agent" id="id_agent" required>
            <option value="">-- Choisir un agent --</option>
            <?php foreach ($agents as $agent): ?>
                <option value="<?= $agent['id_agent'] ?>" <?= $agent['id_agent'] == $relation['id_agent'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($agent['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <button type="submit">Mettre à jour</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>