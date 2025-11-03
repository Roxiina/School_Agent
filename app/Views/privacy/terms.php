<?php
/**
 * Vue : Conditions générales d'utilisation
 */
?>

<div class="privacy-container">
    <div class="privacy-header">
        <h1><i class="fas fa-file-contract"></i> Conditions générales d'utilisation</h1>
        <p class="privacy-subtitle">Dernière mise à jour : <?= date('d/m/Y') ?></p>
    </div>

    <div class="privacy-content">
        <section class="privacy-section">
            <h2>1. Acceptation des conditions</h2>
            <p>En accédant et en utilisant la plateforme School Agent, vous acceptez d'être lié par ces conditions générales d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser notre service.</p>
        </section>

        <section class="privacy-section">
            <h2>2. Description du service</h2>
            <p>School Agent est une plateforme éducative qui met en relation les étudiants avec des agents pédagogiques IA pour les accompagner dans leur apprentissage.</p>
            
            <h3>Services proposés :</h3>
            <ul>
                <li>Assistance pédagogique personnalisée</li>
                <li>Conversations avec des agents IA spécialisés</li>
                <li>Suivi de progression</li>
                <li>Ressources éducatives adaptées</li>
            </ul>
        </section>

        <section class="privacy-section">
            <h2>3. Inscription et compte utilisateur</h2>
            <p>Pour utiliser nos services, vous devez créer un compte et fournir des informations exactes et complètes. Vous êtes responsable de la confidentialité de votre mot de passe.</p>
        </section>

        <section class="privacy-section">
            <h2>4. Utilisation acceptable</h2>
            <p>Vous vous engagez à utiliser School Agent de manière responsable et conforme à la loi. Il est interdit :</p>
            <ul>
                <li>D'utiliser le service à des fins illégales</li>
                <li>De partager des contenus inappropriés ou offensants</li>
                <li>De tenter de compromettre la sécurité du système</li>
                <li>D'usurper l'identité d'autrui</li>
            </ul>
        </section>

        <section class="privacy-section">
            <h2>5. Propriété intellectuelle</h2>
            <p>Tous les contenus de la plateforme (textes, images, logos, etc.) sont protégés par le droit d'auteur. Toute reproduction non autorisée est interdite.</p>
        </section>

        <section class="privacy-section">
            <h2>6. Responsabilité</h2>
            <p>School Agent s'efforce de fournir un service de qualité mais ne peut garantir l'exactitude complète des informations fournies par les agents IA. L'utilisation du service se fait sous votre responsabilité.</p>
        </section>

        <section class="privacy-section">
            <h2>7. Modifications des conditions</h2>
            <p>Nous nous réservons le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés des changements importants par email ou notification sur la plateforme.</p>
        </section>

        <section class="privacy-section">
            <h2>8. Résiliation</h2>
            <p>Vous pouvez fermer votre compte à tout moment. Nous nous réservons le droit de suspendre ou fermer un compte en cas de violation de ces conditions.</p>
        </section>

        <section class="privacy-section">
            <h2>9. Contact</h2>
            <p>Pour toute question concernant ces conditions, contactez-nous :</p>
            <div class="contact-info">
                <p><i class="fas fa-envelope"></i> Email : legal@schoolagent.com</p>
                <p><i class="fas fa-phone"></i> Téléphone : +33 1 23 45 67 89</p>
                <p><i class="fas fa-map-marker-alt"></i> Adresse : 123 Rue de l'Éducation, 75001 Paris</p>
            </div>
        </section>
    </div>

    <div class="privacy-actions">
        <a href="?page=home" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à l'accueil
        </a>
        <a href="?page=privacy" class="btn btn-primary">
            <i class="fas fa-shield-alt"></i> Centre de confidentialité
        </a>
    </div>
</div>

<style>
.privacy-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.privacy-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 15px;
    color: white;
}

.privacy-header h1 {
    margin: 0 0 1rem 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.privacy-subtitle {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.privacy-content {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.privacy-section {
    margin-bottom: 2rem;
}

.privacy-section h2 {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--accent-color);
}

.privacy-section h3 {
    color: var(--text-color);
    font-size: 1.2rem;
    margin: 1rem 0 0.5rem 0;
}

.privacy-section p {
    line-height: 1.6;
    margin-bottom: 1rem;
    color: var(--text-secondary);
}

.privacy-section ul {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.privacy-section li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
    color: var(--text-secondary);
}

.contact-info {
    background: var(--background-light);
    padding: 1.5rem;
    border-radius: 10px;
    margin-top: 1rem;
}

.contact-info p {
    margin: 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.contact-info i {
    color: var(--primary-color);
    width: 20px;
}

.privacy-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .privacy-header h1 {
        font-size: 2rem;
    }
    
    .privacy-content {
        padding: 1.5rem;
    }
    
    .privacy-actions {
        flex-direction: column;
    }
}
</style>