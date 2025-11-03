        </div>
    </main>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>🎓 School Agent</h3>
                    <p style="color: var(--gray-400); margin-bottom: 1rem;">
                        Assistant IA pour l'apprentissage et l'accompagnement scolaire personnalisé.
                    </p>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">
                        Développé avec ❤️ par Olivier / Nicolas / Flavie
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>📚 Services</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="?page=conversation">Conversations IA</a>
                        <a href="?page=subject">Matières</a>
                        <a href="?page=level">Niveaux scolaires</a>
                        <a href="?page=user">Gestion utilisateurs</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>🔒 Confidentialité & Légal</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="?page=privacy">Politique de confidentialité</a>
                        <a href="?page=privacy&action=terms">Conditions d'utilisation</a>
                        <a href="?page=privacy&action=cookies">Gestion des cookies</a>
                        <a href="?page=privacy&action=data_request">Mes données (RGPD)</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>📞 Contact</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="mailto:contact@schoolagent.fr">Support technique</a>
                        <a href="mailto:dpo@schoolagent.fr">Délégué à la protection des données</a>
                        <a href="https://www.cnil.fr" target="_blank">CNIL - Vos droits</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> School Agent. Tous droits réservés.</p>
                <p style="font-size: 0.875rem; margin-top: 0.5rem;">
                    Conforme au RGPD • Hébergé en France • 
                    <button onclick="window.schoolAgent?.showCookiePreferences?.()" 
                            style="background: none; border: none; color: var(--gray-400); text-decoration: underline; cursor: pointer;">
                        Gérer les cookies
                    </button>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>