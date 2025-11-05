<?php require_once __DIR__ . '/../../templates/admin_header.php'; ?>

<h1>Ajouter un agent</h1>

<form action="/admin/agent/create" method="POST">
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="text" name="avatar" placeholder="URL Avatar (optionnel)"><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" step="0.1" name="temperature" placeholder="Température IA (ex: 1.0)" value="1"><br>
    <textarea name="system_prompt" placeholder="System prompt (optionnel)"></textarea><br>
    <input type="text" name="model" placeholder="Modèle IA (ex: llama-3.1-8b-instant)" value="llama-3.1-8b-instant" required><br>
    <input type="number" name="max_completion_tokens" placeholder="Max tokens (ex: 512)" value="512" required><br>

    <button type="submit">✅ Enregistrer</button>
</form>

<?php require_once __DIR__ . '/../../templates/admin_footer.php'; ?>
