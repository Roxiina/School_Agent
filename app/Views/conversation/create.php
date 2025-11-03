<?php 
require_once __DIR__ . '/../templates/header.php';
use SchoolAgent\Config\Authenticator;

Authenticator::startSession();
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', system-ui, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 0 20px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .form-card h1 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 28px;
    }

    .form-card .subtitle {
        color: #64748b;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group select option {
        padding: 10px;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    .btn {
        flex: 1;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: #e5e5e5;
        color: #2c3e50;
    }

    .btn-secondary:hover {
        background: #d5d5d5;
    }

    .agent-preview {
        background: #f8fafc;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 12px;
        margin-top: 8px;
        display: none;
    }

    .agent-preview.visible {
        display: block;
    }

    .agent-preview-title {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .agent-preview-content {
        font-size: 13px;
        color: #2c3e50;
        line-height: 1.4;
    }

    .help-text {
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
    }

    .form-card .icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="form-card">
        <div class="icon">💬</div>
        <h1>Nouvelle Conversation</h1>
        <p class="subtitle">Sélectionnez un agent IA et donnez un titre à votre conversation</p>

        <form method="POST" action="?page=conversation/create">
            <div class="form-group">
                <label for="titre">Titre de la conversation *</label>
                <input 
                    type="text" 
                    id="titre"
                    name="titre" 
                    placeholder="Ex: Révisions de mathématiques"
                    required
                >
                <p class="help-text">Choisissez un titre descriptif pour votre conversation</p>
            </div>

            <div class="form-group">
                <label for="id_agent">Sélectionnez un agent IA *</label>
                <select id="id_agent" name="id_agent" required onchange="updateAgentPreview()">
                    <option value="">-- Choisir un agent --</option>
                    <?php foreach ($agents as $agent): ?>
                        <option value="<?= $agent['id_agent'] ?>" data-description="<?= htmlspecialchars($agent['description']) ?>">
                            🤖 <?= htmlspecialchars($agent['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="help-text">Sélectionnez l'agent IA avec lequel vous souhaitez discuter</p>
                
                <div class="agent-preview" id="agentPreview">
                    <div class="agent-preview-title">📋 Aperçu de l'agent</div>
                    <div class="agent-preview-content" id="agentDescription"></div>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Créer la conversation
                </button>
                <a href="?page=dashboard" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateAgentPreview() {
        const select = document.getElementById('id_agent');
        const preview = document.getElementById('agentPreview');
        const description = document.getElementById('agentDescription');
        
        if (select.value) {
            const option = select.options[select.selectedIndex];
            const desc = option.getAttribute('data-description');
            description.textContent = desc;
            preview.classList.add('visible');
        } else {
            preview.classList.remove('visible');
        }
    }
</script>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
