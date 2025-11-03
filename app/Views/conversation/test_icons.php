<?php
// Page de test pour vérifier que le chat.php fonctionne
// Cette page teste l'affichage direct sans passer par le contrôleur

require __DIR__ . '/../templates/header.php';

// Test pour vérifier que FontAwesome est chargé
?>

<div style="padding: 20px; background: #f0f2f8; margin: 20px; border-radius: 8px; text-align: center;">
    <h2>🧪 TEST - Vérification des Icônes FontAwesome</h2>
    <p style="margin: 20px 0;">Voici un test des icônes qui devraient apparaître dans le chat :</p>
    
    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin: 30px 0;">
        <div style="text-align: center;">
            <i class="fas fa-comment-circle-plus" style="font-size: 32px; color: #667eea;"></i>
            <p>Nouvelle Conv</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-search" style="font-size: 32px; color: #667eea;"></i>
            <p>Rechercher</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-trash-alt" style="font-size: 32px; color: #667eea;"></i>
            <p>Supprimer</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-sliders-h" style="font-size: 32px; color: #667eea;"></i>
            <p>Paramètres</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-download" style="font-size: 32px; color: #667eea;"></i>
            <p>Télécharger</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-bars" style="font-size: 32px; color: #667eea;"></i>
            <p>Menu</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-circle-info" style="font-size: 32px; color: #667eea;"></i>
            <p>Infos</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-ellipsis-vertical" style="font-size: 32px; color: #667eea;"></i>
            <p>Plus</p>
        </div>
        <div style="text-align: center;">
            <i class="fas fa-paper-plane" style="font-size: 32px; color: #667eea;"></i>
            <p>Envoyer</p>
        </div>
    </div>

    <hr style="margin: 30px 0; border: none; border-top: 2px solid #ddd;">

    <div style="background: white; padding: 20px; border-radius: 8px; text-align: left; max-width: 600px; margin: 20px auto;">
        <h3>ℹ️ Instructions pour accéder au chat :</h3>
        <ol style="line-height: 1.8;">
            <li><strong>Assurez-vous d'être connecté</strong> avec : <code>alice.dupont@example.com / password1</code></li>
            <li><strong>Videz le cache du navigateur</strong> : 
                <ul>
                    <li>Chrome : Ctrl + Shift + Delete</li>
                    <li>Firefox : Ctrl + Shift + Maj + Delete</li>
                    <li>Edge : Ctrl + Shift + Delete</li>
                </ul>
            </li>
            <li><strong>Accédez à la page</strong> : <a href="?page=conversation/chat" style="color: #667eea; text-decoration: none; font-weight: bold;">?page=conversation/chat</a></li>
            <li>Les icônes devraient maintenant apparaître correctement</li>
        </ol>
    </div>

    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px auto; max-width: 600px; color: #856404;">
        <strong>⚠️ Note :</strong> Si les icônes n'apparaissent pas, cela signifie que :
        <ul style="margin-top: 10px;">
            <li>FontAwesome n'est pas chargé correctement</li>
            <li>Vous n'êtes pas connecté</li>
            <li>Le cache du navigateur n'a pas été vidé</li>
        </ul>
    </div>
</div>

<script>
    // Vérifier que FontAwesome est chargé
    document.addEventListener('DOMContentLoaded', function() {
        const faCheck = document.querySelector('.fas');
        if (faCheck) {
            console.log('✅ FontAwesome est correctement chargé');
        } else {
            console.error('❌ FontAwesome ne semble pas chargé');
        }
    });
</script>
