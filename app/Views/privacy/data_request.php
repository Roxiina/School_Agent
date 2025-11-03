<?php
/**
 * Vue : Formulaire de demande de données personnelles (RGPD)
 */
?>

<div class="data-request-container">
    <div class="data-request-header">
        <h1><i class="fas fa-database"></i> Mes données personnelles</h1>
        <p class="data-request-subtitle">Exercez vos droits RGPD : accédez, rectifiez ou supprimez vos données</p>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            Votre demande a été enregistrée avec succès ! Nous vous contacterons dans un délai maximum de 30 jours.
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="data-request-content">
        <div class="rights-info">
            <h2><i class="fas fa-balance-scale"></i> Vos droits RGPD</h2>
            
            <div class="rights-grid">
                <div class="right-card">
                    <i class="fas fa-eye"></i>
                    <h3>Droit d'accès</h3>
                    <p>Obtenez une copie de toutes les données personnelles que nous détenons sur vous.</p>
                </div>
                
                <div class="right-card">
                    <i class="fas fa-edit"></i>
                    <h3>Droit de rectification</h3>
                    <p>Demandez la correction de données inexactes ou incomplètes.</p>
                </div>
                
                <div class="right-card">
                    <i class="fas fa-trash-alt"></i>
                    <h3>Droit à l'effacement</h3>
                    <p>Demandez la suppression de vos données personnelles ("droit à l'oubli").</p>
                </div>
                
                <div class="right-card">
                    <i class="fas fa-download"></i>
                    <h3>Droit à la portabilité</h3>
                    <p>Récupérez vos données dans un format structuré et lisible.</p>
                </div>
                
                <div class="right-card">
                    <i class="fas fa-pause"></i>
                    <h3>Droit de limitation</h3>
                    <p>Demandez la limitation du traitement de vos données.</p>
                </div>
                
                <div class="right-card">
                    <i class="fas fa-ban"></i>
                    <h3>Droit d'opposition</h3>
                    <p>Opposez-vous au traitement de vos données pour des raisons légitimes.</p>
                </div>
            </div>
        </div>

        <div class="request-form-section">
            <h2><i class="fas fa-paper-plane"></i> Faire une demande</h2>
            
            <form method="POST" action="?page=data-request" class="data-request-form">
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i> Nom complet *
                    </label>
                    <input type="text" id="name" name="name" required 
                           placeholder="Votre nom et prénom">
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Adresse email *
                    </label>
                    <input type="email" id="email" name="email" required 
                           placeholder="votre.email@exemple.com">
                    <small>Utilisez l'email associé à votre compte School Agent</small>
                </div>

                <div class="form-group">
                    <label for="request_type">
                        <i class="fas fa-list"></i> Type de demande *
                    </label>
                    <select id="request_type" name="request_type" required>
                        <option value="">Sélectionnez le type de demande</option>
                        <option value="access">Droit d'accès - Obtenir mes données</option>
                        <option value="rectification">Droit de rectification - Corriger mes données</option>
                        <option value="erasure">Droit à l'effacement - Supprimer mes données</option>
                        <option value="portability">Droit à la portabilité - Exporter mes données</option>
                        <option value="restriction">Droit de limitation - Limiter le traitement</option>
                        <option value="objection">Droit d'opposition - M'opposer au traitement</option>
                        <option value="consent_withdrawal">Retirer mon consentement</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">
                        <i class="fas fa-comment-alt"></i> Détails de votre demande
                    </label>
                    <textarea id="message" name="message" rows="5" 
                              placeholder="Précisez votre demande, les données concernées, ou toute information utile..."></textarea>
                </div>

                <div class="form-group verification-section">
                    <h3><i class="fas fa-shield-alt"></i> Vérification d'identité</h3>
                    <p>Pour protéger vos données, nous devons vérifier votre identité. Vous recevrez un email de confirmation à l'adresse indiquée.</p>
                    
                    <label class="checkbox-label">
                        <input type="checkbox" name="identity_verification" required>
                        <span class="checkmark"></span>
                        Je confirme être le titulaire de ce compte et accepte les procédures de vérification d'identité
                    </label>
                </div>

                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="privacy_policy" required>
                        <span class="checkmark"></span>
                        J'ai lu et j'accepte la 
                        <a href="?page=privacy" target="_blank">politique de confidentialité</a>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Envoyer la demande
                    </button>
                    <a href="?page=privacy" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="info-section">
        <div class="processing-info">
            <h3><i class="fas fa-clock"></i> Délais de traitement</h3>
            <ul>
                <li><strong>Accusé de réception :</strong> Dans les 72 heures</li>
                <li><strong>Traitement complet :</strong> Maximum 30 jours</li>
                <li><strong>Cas complexes :</strong> Peut être prolongé de 60 jours supplémentaires</li>
            </ul>
        </div>

        <div class="contact-dpo">
            <h3><i class="fas fa-user-tie"></i> Contact du DPO</h3>
            <p>Pour toute question spécifique sur le traitement de vos données :</p>
            <div class="dpo-contact">
                <p><i class="fas fa-envelope"></i> dpo@schoolagent.com</p>
                <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
            </div>
        </div>
    </div>
</div>

<style>
.data-request-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.data-request-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 15px;
    color: white;
}

.data-request-header h1 {
    margin: 0 0 1rem 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.data-request-subtitle {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.data-request-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.rights-info,
.request-form-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.rights-info h2,
.request-form-section h2 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.rights-grid {
    display: grid;
    gap: 1rem;
}

.right-card {
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.right-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.right-card i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.right-card h3 {
    margin: 0 0 0.5rem 0;
    color: var(--text-color);
    font-size: 1.1rem;
}

.right-card p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
}

.data-request-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.verification-section {
    background: var(--background-light);
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid var(--border-color);
}

.verification-section h3 {
    margin: 0 0 1rem 0;
    color: var(--primary-color);
}

.verification-section p {
    margin-bottom: 1rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
}

.info-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.processing-info,
.contact-dpo {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.processing-info h3,
.contact-dpo h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.processing-info ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.processing-info li {
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-secondary);
}

.processing-info li:last-child {
    border-bottom: none;
}

.dpo-contact {
    margin-top: 1rem;
}

.dpo-contact p {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0.5rem 0;
    color: var(--text-color);
}

.dpo-contact i {
    color: var(--primary-color);
    width: 20px;
}

@media (max-width: 768px) {
    .data-request-content,
    .info-section {
        grid-template-columns: 1fr;
    }
    
    .data-request-header h1 {
        font-size: 2rem;
    }
}
</style>