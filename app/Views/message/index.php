<?php $pageTitle = 'Messages'; require __DIR__ . '/../templates/header.php'; ?>

<div style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem;">
    <h1>💬 Messages</h1>
    
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f8f9fa;">
                <tr>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #ddd;">Contenu</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #ddd;">Conversation</th>
                    <th style="padding: 1rem; text-align: left; border-bottom: 2px solid #ddd;">Créé</th>
                    <th style="padding: 1rem; text-align: center; border-bottom: 2px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem;"><?php echo htmlspecialchars(substr($message['contenu'], 0, 50) . '...'); ?></td>
                        <td style="padding: 1rem;"><?php echo htmlspecialchars($message['titre'] ?? 'N/A'); ?></td>
                        <td style="padding: 1rem;"><?php echo htmlspecialchars($message['date_creation']); ?></td>
                        <td style="padding: 1rem; text-align: center;">
                            <a href="?page=message&action=show&id=<?php echo $message['id_message']; ?>" 
                               style="color: #667eea; text-decoration: none; margin-right: 1rem;">
                                👁️ Voir
                            </a>
                            <a href="?page=message&action=delete&id=<?php echo $message['id_message']; ?>" 
                               style="color: #e74c3c; text-decoration: none;"
                               onclick="return confirm('Êtes-vous sûr ?')">
                                🗑️ Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
