<?php $pageTitle = 'Nouvelle Conversation'; require __DIR__ . '/../templates/header.php'; ?>

<h1><i class="fas fa-plus-circle"></i> Créer une Conversation</h1>

<form method="POST" style="max-width: 500px; margin: 2rem auto;">
    <div style="margin-bottom: 1rem;">
        <label for="title"><i class="fas fa-heading"></i> Titre</label>
        <input type="text" id="title" name="title" placeholder="Ex: Révision des équations" required style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 1rem;">
        <label for="agent_id"><i class="fas fa-robot"></i> Agent</label>
        <select id="agent_id" name="agent_id" style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="1">Agent Mathéo (Mathématiques)</option>
            <option value="2">Agent Histoire</option>
            <option value="3">Agent Scolaire</option>
        </select>
    </div>

    <div style="margin-bottom: 1rem;">
        <label for="subject_id"><i class="fas fa-bookmark"></i> Matière</label>
        <select id="subject_id" name="subject_id" style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="1">Mathématiques</option>
            <option value="2">Histoire</option>
            <option value="3">Méthodologie</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-plus"></i> Créer</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>