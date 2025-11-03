<?php $pageTitle = 'Modifier Conversation'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-edit"></i> Modifier la Conversation</h1>

<form method="POST" style="max-width: 500px; margin: 2rem auto;">
    <div style="margin-bottom: 1rem;">
        <label for="title"><i class="fas fa-heading"></i> Titre</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($conversation['titre'] ?? ''); ?>" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-save"></i> Enregistrer</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>