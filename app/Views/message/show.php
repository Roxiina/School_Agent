<?php $pageTitle = 'Message'; require __DIR__ . '/../templates/header.php'; ?>

<div style="max-width: 900px; margin: 2rem auto; padding: 0 1rem;">
    <h1>💬 Message</h1>
    
    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <div style="margin-bottom: 2rem;">
            <h3>Contenu:</h3>
            <p style="background: #f8f9fa; padding: 1rem; border-radius: 4px;">
                <?php echo htmlspecialchars($message['contenu']); ?>
            </p>
        </div>
        
        <p><strong>Conversation:</strong> <?php echo htmlspecialchars($message['titre'] ?? 'N/A'); ?></p>
        <p><strong>Créé le:</strong> <?php echo htmlspecialchars($message['date_creation']); ?></p>
        
        <div style="margin-top: 2rem;">
            <a href="?page=message" style="color: #667eea; text-decoration: none; margin-right: 1rem;">← Retour aux messages</a>
            <a href="?page=conversation&action=show&id=<?php echo htmlspecialchars($message['id_conversation']); ?>" 
               style="color: #667eea; text-decoration: none;">Voir la conversation</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
