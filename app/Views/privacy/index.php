<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="fade-in">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">🔒 Politique de Confidentialité</h1>
            <p class="card-subtitle">
                School Agent respecte votre vie privée et s'engage à protéger vos données personnelles.
            </p>
        </div>

        <div style="line-height: 1.8;">
            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">1. Collecte des Données</h2>
            <p>
                <strong>Données que nous collectons :</strong><br>
                • Informations de compte (nom, prénom, email)<br>
                • Historique des conversations avec nos agents IA<br>
                • Données d'utilisation du site (pages visitées, temps passé)<br>
                • Préférences d'apprentissage et niveau scolaire
            </p>

            <div class="alert alert-info">
                <strong>🛡️ Principe de minimisation :</strong> Nous ne collectons que les données strictement nécessaires au fonctionnement de nos services éducatifs.
            </div>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">2. Utilisation des Données</h2>
            <p>
                <strong>Vos données sont utilisées pour :</strong><br>
                • Personnaliser votre expérience d'apprentissage<br>
                • Améliorer nos agents IA et leurs réponses<br>
                • Vous envoyer des notifications importantes (avec votre consentement)<br>
                • Analyser l'utilisation de la plateforme pour l'améliorer
            </p>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">3. Base Légale (RGPD)</h2>
            <div class="grid grid-2">
                <div class="card" style="background: var(--gray-50); margin: 0;">
                    <h3>📋 Exécution d'un contrat</h3>
                    <p>Traitement nécessaire pour fournir nos services éducatifs</p>
                </div>
                <div class="card" style="background: var(--gray-50); margin: 0;">
                    <h3>✅ Consentement</h3>
                    <p>Pour les cookies analytiques et communications marketing</p>
                </div>
            </div>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">4. Partage des Données</h2>
            <div class="alert alert-warning">
                <strong>🚫 Nous ne vendons jamais vos données.</strong> Elles peuvent être partagées uniquement avec :
                <ul style="margin-top: 0.5rem;">
                    <li>Nos prestataires techniques (hébergement, analyse)</li>
                    <li>Les autorités légales sur demande judiciaire</li>
                </ul>
            </div>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">5. Vos Droits RGPD</h2>
            <div class="grid grid-3">
                <div class="card" style="margin: 0; text-align: center;">
                    <h4>📄 Accès</h4>
                    <p>Consulter vos données</p>
                </div>
                <div class="card" style="margin: 0; text-align: center;">
                    <h4>✏️ Rectification</h4>
                    <p>Corriger vos informations</p>
                </div>
                <div class="card" style="margin: 0; text-align: center;">
                    <h4>🗑️ Effacement</h4>
                    <p>Supprimer vos données</p>
                </div>
            </div>

            <div style="background: var(--primary-color); color: white; padding: 2rem; border-radius: var(--border-radius); margin: 2rem 0;">
                <h3 style="color: white; margin-bottom: 1rem;">🔧 Exercer vos droits</h3>
                <p style="margin-bottom: 1rem;">
                    Pour toute demande concernant vos données personnelles, contactez notre DPO :
                </p>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <a href="?page=privacy&action=data_request" class="btn btn-outline" style="background: white; color: var(--primary-color);">
                        Faire une demande RGPD
                    </a>
                    <span>ou</span>
                    <a href="mailto:dpo@schoolagent.fr" style="color: white;">dpo@schoolagent.fr</a>
                </div>
            </div>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">6. Sécurité des Données</h2>
            <p>
                <strong>Mesures de protection :</strong><br>
                • Chiffrement des données sensibles (HTTPS/SSL)<br>
                • Accès restreint aux données personnelles<br>
                • Sauvegardes sécurisées et régulières<br>
                • Audit de sécurité périodique
            </p>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">7. Conservation des Données</h2>
            <div class="alert alert-info">
                <strong>⏰ Durée de conservation :</strong><br>
                • Données de compte : Pendant la durée d'utilisation + 3 ans<br>
                • Conversations : 2 ans après la dernière activité<br>
                • Logs techniques : 1 an maximum<br>
                • Données analytiques : 26 mois (Google Analytics)
            </div>

            <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">8. Contact et Réclamations</h2>
            <p>
                <strong>Délégué à la Protection des Données (DPO) :</strong><br>
                Email : dpo@schoolagent.fr<br>
                Adresse : [Votre adresse]<br><br>
                
                <strong>Droit de réclamation :</strong><br>
                Vous pouvez déposer une réclamation auprès de la CNIL : 
                <a href="https://www.cnil.fr" target="_blank" style="color: var(--primary-color);">www.cnil.fr</a>
            </p>

            <div style="background: var(--gray-50); padding: 1.5rem; border-radius: var(--border-radius); margin-top: 2rem;">
                <p style="margin: 0; font-size: 0.875rem; color: var(--gray-600);">
                    <strong>Dernière mise à jour :</strong> <?= date('d/m/Y') ?><br>
                    Cette politique peut être modifiée. Nous vous informerons de tout changement important.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-3">
        <a href="?page=privacy&action=terms" class="card" style="text-decoration: none; color: inherit;">
            <h3>📋 Conditions d'utilisation</h3>
            <p>Règles d'usage de School Agent</p>
        </a>
        
        <a href="?page=privacy&action=cookies" class="card" style="text-decoration: none; color: inherit;">
            <h3>🍪 Politique des cookies</h3>
            <p>Gestion de vos préférences</p>
        </a>
        
        <a href="?page=privacy&action=data_request" class="card" style="text-decoration: none; color: inherit;">
            <h3>🔧 Mes données</h3>
            <p>Exercer vos droits RGPD</p>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>