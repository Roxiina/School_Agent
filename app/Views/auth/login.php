<?php 
$title = "Connexion - School Agent";
$metaDescription = "Connectez-vous à votre compte School Agent pour accéder à vos conversations avec les agents IA.";

use SchoolAgent\Config\Authenticator;
// On démarre la session sur toutes les pages
Authenticator::startSession();
$flash = Authenticator::getFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $metaDescription ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php if ($flash): ?>
        <div style="position: fixed; top: 20px; right: 20px; z-index: 9999; padding: 1rem; border-radius: 8px; font-weight: 500; <?= $flash['type'] === 'error' ? 'background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;' : 'background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

<div class="auth-background">
    <div class="auth-particles"></div>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <!-- Lien retour à l'accueil -->
                <div style="text-align: left; margin-bottom: 1rem;">
                    <a href="?" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #64748b; text-decoration: none; font-weight: 500; font-size: 0.9rem; transition: all 0.3s ease;" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Retour à l'accueil
                    </a>
                </div>
                
                <div class="auth-logo">
                    <div class="logo-inner">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="logo-glow"></div>
                </div>
                <h1>Bienvenue sur School Agent</h1>
                <p class="auth-subtitle">Votre assistant IA pour l'apprentissage personnalisé</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error animate-shake">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="?page=login" class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse email
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required 
                            autocomplete="email"
                            placeholder="votre.email@exemple.com"
                            value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                        >
                        <div class="input-focus-border"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <div class="input-wrapper">
                        <div class="password-input">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="Votre mot de passe"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                        <div class="input-focus-border"></div>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember_me" id="remember_me">
                        <span class="checkmark">
                            <i class="fas fa-check"></i>
                        </span>
                        Se souvenir de moi
                    </label>
                    <a href="?page=forgot-password" class="link-forgot">
                        Mot de passe oublié ?
                    </a>
                </div>

                <div class="form-group rgpd-notice">
                    <div class="rgpd-card">
                        <div class="rgpd-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="rgpd-content">
                            <p>En vous connectant, vous acceptez notre 
                                <a href="?page=privacy" target="_blank">politique de confidentialité</a> 
                                et l'utilisation de cookies nécessaires.
                            </p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>
            </form>

            <div class="auth-divider">
                <span>Nouveau sur School Agent ?</span>
            </div>

            <div style="text-align: center; margin-bottom: 2rem;">
                <a href="?page=register" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i>
                    Créer un compte gratuit
                </a>
            </div>

            <div class="auth-features">
                <h3><i class="fas fa-star"></i> Pourquoi choisir School Agent ?</h3>
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="feature-content">
                            <h4>IA Spécialisée</h4>
                            <p>Agents experts par matière</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Suivi Personnalisé</h4>
                            <p>Progression adaptée</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <div class="feature-content">
                            <h4>100% Sécurisé</h4>
                            <p>Données protégées</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="feature-content">
                            <h4>24h/24</h4>
                            <p>Toujours disponible</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-footer">
                <div class="security-badges">
                    <div class="badge">
                        <i class="fas fa-lock"></i>
                        <span>SSL Sécurisé</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>RGPD</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-cookie-bite"></i>
                        <span>Cookies</span>
                    </div>
                </div>
                <p class="legal-text">
                    <a href="?page=privacy">Confidentialité</a> • 
                    <a href="?page=terms">Conditions</a> • 
                    <a href="?page=data-request">Mes données</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS modernes */
:root {
    --auth-primary: #667eea;
    --auth-secondary: #764ba2;
    --auth-accent: #f093fb;
    --auth-success: #4facfe;
    --auth-error: #ff6b6b;
    --auth-warning: #feca57;
    --auth-dark: #2c3e50;
    --auth-light: #ffffff;
    --auth-gray-50: #f8fafc;
    --auth-gray-100: #f1f5f9;
    --auth-gray-200: #e2e8f0;
    --auth-gray-300: #cbd5e1;
    --auth-gray-400: #94a3b8;
    --auth-gray-500: #64748b;
    --auth-gray-600: #475569;
    --auth-gray-700: #334155;
    --auth-gray-800: #1e293b;
    --auth-gray-900: #0f172a;
    
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
}

/* Arrière-plan animé */
.auth-background {
    min-height: 100vh;
    position: relative;
    background: linear-gradient(135deg, 
        var(--auth-primary) 0%, 
        var(--auth-secondary) 35%,
        var(--auth-accent) 100%);
    overflow: hidden;
}

.auth-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255,255,255,0.05) 0%, transparent 50%);
    animation: backgroundShift 20s ease-in-out infinite;
}

@keyframes backgroundShift {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.1); }
}

/* Particules animées */
.auth-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.auth-particles::before,
.auth-particles::after {
    content: '';
    position: absolute;
    width: 3px;
    height: 3px;
    background: rgba(255,255,255,0.3);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.auth-particles::before {
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.auth-particles::after {
    top: 20%;
    right: 20%;
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
    50% { transform: translateY(-20px) rotate(180deg); opacity: 1; }
}

/* Container principal */
.auth-container {
    position: relative;
    z-index: 10;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

/* Carte de connexion */
.auth-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem;
    max-width: 500px;
    width: 100%;
    box-shadow: var(--shadow-2xl), 0 0 0 1px rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    animation: slideInUp 0.8s ease-out;
    position: relative;
    overflow: hidden;
}

.auth-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--auth-primary), var(--auth-accent));
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Header de la carte */
.auth-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.auth-logo {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-inner {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--auth-primary), var(--auth-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 2;
    box-shadow: var(--shadow-lg);
    animation: logoFloat 3s ease-in-out infinite;
}

.logo-inner i {
    font-size: 2.5rem;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.logo-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, var(--auth-accent) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0.3;
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

@keyframes glow {
    from { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
    to { transform: translate(-50%, -50%) scale(1.1); opacity: 0.5; }
}

.auth-header h1 {
    margin: 0 0 1rem 0;
    color: var(--auth-dark);
    font-size: 2.25rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--auth-primary), var(--auth-secondary));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-align: center;
}

.auth-subtitle {
    color: var(--auth-gray-600);
    margin: 0;
    font-size: 1.125rem;
    line-height: 1.6;
    font-weight: 400;
}

/* Formulaire */
.auth-form {
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--auth-gray-700);
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 0.975rem;
}

.input-wrapper {
    position: relative;
}

.form-group input {
    width: 100%;
    padding: 1.25rem 1rem;
    border: 2px solid var(--auth-gray-200);
    border-radius: 16px;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--auth-gray-50);
    color: var(--auth-gray-900);
    position: relative;
    z-index: 1;
}

.form-group input:focus {
    border-color: var(--auth-primary);
    background: white;
    outline: none;
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg), 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.input-focus-border {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--auth-primary), var(--auth-accent));
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 1px;
}

.form-group input:focus + .input-focus-border {
    width: 100%;
}

.password-input {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--auth-gray-400);
    cursor: pointer;
    padding: 0.75rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    z-index: 2;
}

.password-toggle:hover {
    color: var(--auth-primary);
    background: var(--auth-gray-100);
}

/* Options du formulaire */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    color: var(--auth-gray-600);
    font-size: 0.975rem;
    user-select: none;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
    margin: 0;
    opacity: 0;
    position: absolute;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid var(--auth-gray-300);
    border-radius: 6px;
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
}

.checkbox-label input:checked + .checkmark {
    background: var(--auth-primary);
    border-color: var(--auth-primary);
    transform: scale(1.05);
}

.checkmark i {
    color: white;
    font-size: 0.75rem;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.checkbox-label input:checked + .checkmark i {
    opacity: 1;
}

.link-forgot {
    color: var(--auth-primary);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.975rem;
    transition: all 0.3s ease;
}

.link-forgot:hover {
    color: var(--auth-secondary);
    text-decoration: underline;
}

/* Notice RGPD améliorée */
.rgpd-notice {
    margin-bottom: 2rem;
}

.rgpd-card {
    background: linear-gradient(135deg, var(--auth-gray-50), white);
    padding: 1.5rem;
    border-radius: 16px;
    border: 1px solid var(--auth-gray-200);
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.rgpd-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--auth-primary), var(--auth-accent));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.125rem;
}

.rgpd-content p {
    margin: 0;
    font-size: 0.925rem;
    color: var(--auth-gray-600);
    line-height: 1.6;
}

.rgpd-content a {
    color: var(--auth-primary);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.rgpd-content a:hover {
    color: var(--auth-secondary);
    text-decoration: underline;
}

/* Bouton de connexion amélioré */
.btn-login {
    width: 100%;
    padding: 1.25rem 2rem;
    font-size: 1.125rem;
    font-weight: 700;
    border-radius: 16px;
    border: none;
    background: linear-gradient(135deg, var(--auth-primary), var(--auth-secondary));
    color: white;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow-lg);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
    background: linear-gradient(135deg, var(--auth-secondary), var(--auth-accent));
}

.btn-login:active {
    transform: translateY(0);
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-login:hover::before {
    left: 100%;
}

.btn-text {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: opacity 0.3s ease;
}

.btn-loader {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.spinner {
    width: 24px;
    height: 24px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Divider */
.auth-divider {
    position: relative;
    text-align: center;
    margin: 2rem 0;
}

.auth-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--auth-gray-200);
}

.auth-divider span {
    background: rgba(255,255,255,0.95);
    padding: 0 1.5rem;
    color: var(--auth-gray-500);
    font-size: 0.925rem;
    font-weight: 500;
    position: relative;
}

/* Bouton d'inscription */
.btn-outline {
    width: auto;
    padding: 0.75rem 1.5rem;
    font-size: 0.925rem;
    font-weight: 500;
    border-radius: 10px;
    border: 1.5px solid var(--auth-primary);
    background: transparent;
    color: var(--auth-primary);
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
    margin: 0 auto;
}

.btn-outline:hover {
    background: var(--auth-primary);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Features améliorées */
.auth-features {
    background: linear-gradient(135deg, var(--auth-gray-50), white);
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    border: 1px solid var(--auth-gray-100);
}

.auth-features h3 {
    margin: 0 0 1.5rem 0;
    color: var(--auth-gray-800);
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.auth-features h3 i {
    color: var(--auth-accent);
}

.features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 12px;
    border: 1px solid var(--auth-gray-100);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--auth-primary);
}

.feature-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--auth-primary), var(--auth-accent));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.125rem;
}

.feature-content h4 {
    margin: 0 0 0.25rem 0;
    color: var(--auth-gray-800);
    font-size: 0.975rem;
    font-weight: 600;
}

.feature-content p {
    margin: 0;
    color: var(--auth-gray-500);
    font-size: 0.875rem;
}

/* Footer amélioré */
.auth-footer {
    text-align: center;
}

.security-badges {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.825rem;
    color: var(--auth-gray-600);
    padding: 0.5rem 1rem;
    background: white;
    border: 1px solid var(--auth-gray-200);
    border-radius: 20px;
    transition: all 0.3s ease;
}

.badge:hover {
    border-color: var(--auth-primary);
    color: var(--auth-primary);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.badge i {
    color: var(--auth-primary);
}

.legal-text {
    font-size: 0.825rem;
    color: var(--auth-gray-500);
    margin: 0;
    line-height: 1.5;
}

.legal-text a {
    color: var(--auth-primary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.legal-text a:hover {
    color: var(--auth-secondary);
    text-decoration: underline;
}

/* Animations d'erreur */
.animate-shake {
    animation: shake 0.6s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

/* Responsive design */
@media (max-width: 768px) {
    .auth-container {
        padding: 1rem;
    }
    
    .auth-card {
        padding: 2rem;
    }
    
    .auth-header h1 {
        font-size: 1.875rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .form-options {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .security-badges {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 1.5rem;
        border-radius: 16px;
    }
    
    .logo-inner {
        width: 60px;
        height: 60px;
    }
    
    .logo-inner i {
        font-size: 2rem;
    }
    
    .auth-header h1 {
        font-size: 1.625rem;
    }
    
    .auth-subtitle {
        font-size: 1rem;
    }
}

/* États de chargement */
.loading .btn-text {
    opacity: 0;
}

.loading .btn-loader {
    opacity: 1;
}

/* Lien retour à l'accueil */
.back-link:hover {
    color: var(--auth-dark) !important;
    transform: translateX(-2px);
}

.back-link i {
    transition: transform 0.3s ease;
}

.back-link:hover i {
    transform: translateX(-3px);
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
    }
}

// Animation d'entrée pour les éléments
document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.5s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, 100 * index);
    });
});

// Validation en temps réel
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !password) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires.');
        return;
    }
    
    if (!email.includes('@')) {
        e.preventDefault();
        alert('Veuillez entrer une adresse email valide.');
        return;
    }
});
</script>

</body>
</html>