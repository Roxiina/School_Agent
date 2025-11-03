<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="fade-in">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">🍪 Gestion des Cookies</h1>
            <p class="card-subtitle">
                Personnalisez vos préférences concernant l'utilisation des cookies sur School Agent.
            </p>
        </div>

        <div class="alert alert-info">
            <strong>ℹ️ Qu'est-ce qu'un cookie ?</strong><br>
            Un cookie est un petit fichier texte stocké sur votre appareil lors de la visite d'un site web. 
            Il permet de mémoriser vos préférences et d'améliorer votre expérience.
        </div>

        <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">Types de cookies utilisés</h2>

        <div class="grid grid-2">
            <div class="card" style="margin: 0; border-left: 4px solid var(--success-color);">
                <h3>✅ Cookies Nécessaires</h3>
                <p><strong>Obligatoires - Ne peuvent pas être désactivés</strong></p>
                <ul>
                    <li>Gestion de votre session de connexion</li>
                    <li>Mémorisation de vos préférences de cookies</li>
                    <li>Sécurité et prévention de la fraude</li>
                    <li>Fonctionnement technique du site</li>
                </ul>
                <small style="color: var(--gray-600);">
                    <strong>Durée :</strong> Session ou 30 jours maximum
                </small>
            </div>

            <div class="card" style="margin: 0; border-left: 4px solid var(--warning-color);">
                <h3>📊 Cookies d'Analyse</h3>
                <p><strong>Facultatifs - Soumis à votre consentement</strong></p>
                <ul>
                    <li>Statistiques d'utilisation anonymisées</li>
                    <li>Mesure de performance des pages</li>
                    <li>Amélioration de l'expérience utilisateur</li>
                    <li>Détection des problèmes techniques</li>
                </ul>
                <small style="color: var(--gray-600);">
                    <strong>Durée :</strong> 26 mois maximum<br>
                    <strong>Fournisseur :</strong> Google Analytics (données anonymisées)
                </small>
            </div>
        </div>

        <div class="card" style="background: var(--gray-50); margin: 2rem 0;">
            <h3>🔧 Gérer vos préférences</h3>
            <p>Vous pouvez modifier vos choix à tout moment en cliquant sur le bouton ci-dessous :</p>
            <button class="btn btn-primary" onclick="window.schoolAgent?.showCookiePreferences?.() || alert('Veuillez actualiser la page')">
                🍪 Modifier mes préférences de cookies
            </button>
        </div>

        <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">Contrôle par le navigateur</h2>
        
        <div class="grid grid-3">
            <div class="card" style="margin: 0; text-align: center;">
                <h4>🌐 Chrome</h4>
                <p>Paramètres → Confidentialité → Cookies</p>
            </div>
            <div class="card" style="margin: 0; text-align: center;">
                <h4>🦊 Firefox</h4>
                <p>Options → Vie privée → Cookies</p>
            </div>
            <div class="card" style="margin: 0; text-align: center;">
                <h4>🧭 Safari</h4>
                <p>Préférences → Confidentialité</p>
            </div>
        </div>

        <div class="alert alert-warning">
            <strong>⚠️ Important :</strong> La désactivation de certains cookies peut affecter le fonctionnement du site. 
            Les cookies nécessaires ne peuvent pas être désactivés pour garantir la sécurité et les fonctionnalités de base.
        </div>

        <h2 style="color: var(--primary-color); margin: 2rem 0 1rem 0;">Cookies tiers</h2>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Finalité</th>
                        <th>Durée</th>
                        <th>Politique</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Google Analytics</td>
                        <td>Analyse d'audience anonymisée</td>
                        <td>26 mois</td>
                        <td><a href="https://policies.google.com/privacy" target="_blank" style="color: var(--primary-color);">Voir</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="background: var(--primary-color); color: white; padding: 2rem; border-radius: var(--border-radius); margin: 2rem 0;">
            <h3 style="color: white; margin-bottom: 1rem;">📧 Questions sur les cookies ?</h3>
            <p>Pour toute question concernant notre utilisation des cookies, contactez-nous :</p>
            <a href="mailto:dpo@schoolagent.fr" style="color: white; text-decoration: underline;">
                dpo@schoolagent.fr
            </a>
        </div>

        <div style="background: var(--gray-50); padding: 1.5rem; border-radius: var(--border-radius);">
            <p style="margin: 0; font-size: 0.875rem; color: var(--gray-600);">
                <strong>Dernière mise à jour :</strong> <?= date('d/m/Y') ?><br>
                Cette politique peut être modifiée pour refléter les évolutions de nos services ou de la réglementation.
            </p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>