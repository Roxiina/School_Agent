<?php $pageTitle = 'Détails - Matière'; require __DIR__ . '/../templates/header.php'; ?>

<div style="max-width: 900px; margin: 2rem auto; padding: 0 1rem;">
    <h1><?php echo htmlspecialchars($subject['nom_matiere'] ?? 'Matière'); ?></h1>
    
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <div style="margin: 2rem 0;">
            <a href="?page=subject&action=edit&id=<?php echo $subject['id_matiere']; ?>" 
               style="background: #667eea; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 4px; display: inline-block;">
                ✏️ Modifier
            </a>
            <a href="?page=subject&action=delete&id=<?php echo $subject['id_matiere']; ?>" 
               style="background: #e74c3c; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 4px; display: inline-block; margin-left: 1rem;"
               onclick="return confirm('Êtes-vous sûr ?')">
                🗑️ Supprimer
            </a>
        </div>
    <?php endif; ?>
    
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <p><strong>ID:</strong> <?php echo htmlspecialchars($subject['id_matiere']); ?></p>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($subject['nom_matiere']); ?></p>
        <p><strong>Créé le:</strong> <?php echo htmlspecialchars($subject['date_creation'] ?? 'N/A'); ?></p>
    </div>
    
    <a href="?page=subject" style="margin-top: 2rem; display: inline-block; color: #667eea; text-decoration: none;">← Retour</a>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
