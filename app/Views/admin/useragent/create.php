<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>➕ Attribuer un agent à un utilisateur</h1>
<p><a href="/admin/useragent">⬅️ Retour à la liste</a></p>

<form action="/admin/useragent/create" method="POST">
    <label>Utilisateur :</label>
    <select name="id_user" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id_user'] ?>"><?= htmlspecialchars($user['nom'].' '.$user['prenom']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Agent :</label>
    <select name="id_agent" required>
        <?php foreach ($agents as $agent): ?>
            <option value="<?= $agent['id_agent'] ?>"><?= htmlspecialchars($agent['nom']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Attribuer</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
