<?php
/**
 * Vue : Page de contact pour questions légales
 */
?>

<div class="contact-container">
    <div class="contact-header">
        <h1><i class="fas fa-headset"></i> Contact légal</h1>
        <p class="contact-subtitle">Une question sur vos données ou nos conditions ? Contactez-nous !</p>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="contact-content">
        <div class="contact-info-section">
            <h2><i class="fas fa-info-circle"></i> Informations de contact</h2>
            
            <div class="contact-cards">
                <div class="contact-card">
                    <i class="fas fa-envelope-open"></i>
                    <h3>Email</h3>
                    <p>legal@schoolagent.com</p>
                    <span>Réponse sous 48h</span>
                </div>
                
                <div class="contact-card">
                    <i class="fas fa-phone"></i>
                    <h3>Téléphone</h3>
                    <p>+33 1 23 45 67 89</p>
                    <span>Lun-Ven 9h-18h</span>
                </div>
                
                <div class="contact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Adresse</h3>
                    <p>123 Rue de l'Éducation<br>75001 Paris, France</p>
                    <span>Sur rendez-vous</span>
                </div>
                
                <div class="contact-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>DPO</h3>
                    <p>dpo@schoolagent.com</p>
                    <span>Questions RGPD</span>
                </div>
            </div>
        </div>

        <div class="contact-form-section">
            <h2><i class="fas fa-paper-plane"></i> Envoyez-nous un message</h2>
            
            <form method="POST" action="?page=contact" class="contact-form">
                <div class="form-group">
                    <label for="subject">
                        <i class="fas fa-tag"></i> Sujet de votre demande
                    </label>
                    <select id="subject" name="subject" required>
                        <option value="">Sélectionnez un sujet</option>
                        <option value="rgpd">Question RGPD / Données personnelles</option>
                        <option value="terms">Conditions d'utilisation</option>
                        <option value="legal">Question juridique</option>
                        <option value="abuse">Signalement d'abus</option>
                        <option value="other">Autre</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i> Nom complet
                        </label>
                        <input type="text" id="name" name="name" required 
                               placeholder="Votre nom et prénom">
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" id="email" name="email" required 
                               placeholder="votre.email@exemple.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">
                        <i class="fas fa-comment-alt"></i> Message
                    </label>
                    <textarea id="message" name="message" rows="6" required 
                              placeholder="Décrivez votre question ou demande en détail..."></textarea>
                </div>

                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="consent" required>
                        <span class="checkmark"></span>
                        J'accepte que mes données soient traitées pour répondre à ma demande
                        <a href="?page=privacy" target="_blank">(voir notre politique de confidentialité)</a>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Envoyer le message
                    </button>
                    <a href="?page=privacy" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="legal-shortcuts">
        <h3><i class="fas fa-external-link-alt"></i> Liens utiles</h3>
        <div class="shortcuts-grid">
            <a href="?page=privacy" class="shortcut-link">
                <i class="fas fa-user-shield"></i>
                <span>Politique de confidentialité</span>
            </a>
            <a href="?page=cookies" class="shortcut-link">
                <i class="fas fa-cookie-bite"></i>
                <span>Politique des cookies</span>
            </a>
            <a href="?page=terms" class="shortcut-link">
                <i class="fas fa-file-contract"></i>
                <span>Conditions d'utilisation</span>
            </a>
            <a href="?page=data-request" class="shortcut-link">
                <i class="fas fa-download"></i>
                <span>Mes données</span>
            </a>
        </div>
    </div>
</div>

<style>
.contact-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.contact-header {
    text-align: center;
    margin-bottom: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 15px;
    color: white;
}

.contact-header h1 {
    margin: 0 0 1rem 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.contact-subtitle {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.contact-info-section,
.contact-form-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.contact-info-section h2,
.contact-form-section h2 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.contact-cards {
    display: grid;
    gap: 1rem;
}

.contact-card {
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    text-align: center;
    transition: all 0.3s ease;
}

.contact-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-card i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.contact-card h3 {
    margin: 0 0 0.5rem 0;
    color: var(--text-color);
}

.contact-card p {
    margin: 0 0 0.5rem 0;
    font-weight: 500;
    color: var(--text-color);
}

.contact-card span {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.legal-shortcuts {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.legal-shortcuts h3 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 1.3rem;
}

.shortcuts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.shortcut-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--background-light);
    border-radius: 10px;
    text-decoration: none;
    color: var(--text-color);
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.shortcut-link:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.shortcut-link i {
    font-size: 1.2rem;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .contact-content {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .contact-header h1 {
        font-size: 2rem;
    }
    
    .shortcuts-grid {
        grid-template-columns: 1fr;
    }
}
</style>