<!-- AGENT CARD COMPONENT -->
<?php
function renderAgentCard($agent) {
    $icons = [
        'Agent Math' => 'fas fa-calculator',
        'Agent Histoire' => 'fas fa-landmark',
        'Agent Scolaire' => 'fas fa-graduation-cap'
    ];
    
    $classes = [
        'Agent Math' => 'agent-matheo',
        'Agent Histoire' => 'agent-histoire',
        'Agent Scolaire' => 'agent-scolaire'
    ];
    
    $icon = $icons[$agent['nom']] ?? 'fas fa-robot';
    $class = $classes[$agent['nom']] ?? 'agent-default';
?>
    <a href="?page=conversation&agent=<?= $agent['id_agent'] ?>" 
       class="agent-card <?= $class ?> animate-on-scroll" 
       data-agent="<?= strtolower(str_replace(' ', '-', $agent['nom'])) ?>">
        
        <div class="agent-icon">
            <i class="<?= $icon ?>"></i>
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 mb-2">
            <?= htmlspecialchars($agent['nom']) ?>
        </h3>
        
        <p class="text-gray-600 mb-4">
            <?= htmlspecialchars($agent['description']) ?>
        </p>
        
        <div class="bg-gray-50 rounded-lg p-3 mb-4">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">Température IA</span>
                <span class="font-semibold text-gray-900"><?= $agent['temperature'] ?></span>
            </div>
        </div>
        
        <button class="btn btn-primary w-full btn-glow">
            <i class="fas fa-comments mr-2"></i>
            Démarrer une conversation
        </button>
    </a>
<?php } ?>

<!-- STAT CARD COMPONENT -->
<?php
function renderStatCard($icon, $number, $label, $color = 'blue') {
?>
    <div class="stat-card animate-on-scroll">
        <div class="stat-icon bg-gradient-<?= $color ?>">
            <i class="<?= $icon ?>"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-number"><?= $number ?></h3>
            <p><?= $label ?></p>
        </div>
    </div>
<?php } ?>

<!-- USER CARD COMPONENT -->
<?php
function renderUserCard($user) {
    $roleColors = [
        'admin' => 'bg-gradient-red',
        'professeur' => 'bg-gradient-blue',
        'etudiant' => 'bg-gradient-green'
    ];
    
    $roleIcons = [
        'admin' => 'fas fa-shield-alt',
        'professeur' => 'fas fa-chalkboard-teacher',
        'etudiant' => 'fas fa-user-graduate'
    ];
    
    $colorClass = $roleColors[$user['role']] ?? 'bg-gradient-blue';
    $iconClass = $roleIcons[$user['role']] ?? 'fas fa-user';
?>
    <div class="card animate-on-scroll filterable-item" 
         data-role="<?= $user['role'] ?>"
         data-search="<?= strtolower($user['nom'] . ' ' . $user['prenom'] . ' ' . $user['email']) ?>">
        
        <div class="text-center mb-6">
            <div class="w-20 h-20 <?= $colorClass ?> rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="<?= $iconClass ?> text-white text-3xl"></i>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">
                <?= htmlspecialchars($user['nom'] . ' ' . $user['prenom']) ?>
            </h3>
            
            <p class="text-gray-600 mb-3"><?= htmlspecialchars($user['email']) ?></p>
            
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold 
                         <?= $user['role'] === 'admin' ? 'bg-red-100 text-red-800' : 
                             ($user['role'] === 'professeur' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') ?>">
                <i class="<?= $iconClass ?> mr-2"></i>
                <?= ucfirst($user['role']) ?>
            </span>
        </div>

        <div class="space-y-3 mb-6">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                <span class="text-gray-600 font-medium">ID Utilisateur</span>
                <span class="text-gray-900 font-bold">#<?= $user['id_user'] ?></span>
            </div>
            
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                <span class="text-gray-600 font-medium">Niveau</span>
                <span class="text-gray-900 font-bold"><?= htmlspecialchars($user['niveau'] ?? 'Non défini') ?></span>
            </div>
        </div>

        <div class="flex gap-3">
            <button class="flex-1 py-3 px-4 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition font-bold">
                <i class="fas fa-edit mr-2"></i> Modifier
            </button>
            
            <button class="px-4 py-3 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition font-bold">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
<?php } ?>

<!-- CONVERSATION CARD COMPONENT -->
<?php
function renderConversationCard($conversation) {
    $agentColors = [
        'Agent Mathéo' => 'bg-gradient-matheo',
        'Agent Histoire' => 'bg-gradient-histoire',
        'Agent Scolaire' => 'bg-gradient-scolaire'
    ];
    
    $agentIcons = [
        'Agent Mathéo' => 'fas fa-calculator',
        'Agent Histoire' => 'fas fa-landmark',
        'Agent Scolaire' => 'fas fa-graduation-cap'
    ];
    
    $colorClass = $agentColors[$conversation['agent_nom']] ?? 'bg-gradient-blue';
    $iconClass = $agentIcons[$conversation['agent_nom']] ?? 'fas fa-robot';
?>
    <div class="card animate-on-scroll filterable-item" 
         data-agent="<?= strtolower($conversation['agent_nom']) ?>"
         data-search="<?= strtolower($conversation['titre'] . ' ' . $conversation['agent_nom']) ?>">
        
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 <?= $colorClass ?> rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="<?= $iconClass ?> text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">
                        <?= htmlspecialchars($conversation['titre']) ?>
                    </h3>
                    <p class="text-gray-600">
                        avec <?= htmlspecialchars($conversation['agent_nom']) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 mb-4">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600 font-semibold">Date de création</span>
                <span class="text-gray-900 font-medium">
                    <?= date('d/m/Y H:i', strtotime($conversation['date_creation'])) ?>
                </span>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="?page=conversation&id=<?= $conversation['id_conversation'] ?>" 
               class="flex-1 py-3 px-4 bg-green-100 text-green-600 rounded-xl hover:bg-green-200 transition font-bold text-center">
                <i class="fas fa-eye mr-2"></i> Voir détails
            </a>
            
            <button class="px-4 py-3 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition">
                <i class="fas fa-download"></i>
            </button>
        </div>
    </div>
<?php } ?>

<!-- BREADCRUMB COMPONENT -->
<?php
function renderBreadcrumb($items) {
?>
    <nav class="breadcrumb mb-6">
        <?php foreach ($items as $index => $item): ?>
            <?php if ($index > 0): ?>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <?php endif; ?>
            
            <?php if (isset($item['url']) && $index < count($items) - 1): ?>
                <a href="<?= $item['url'] ?>"><?= $item['label'] ?></a>
            <?php else: ?>
                <span class="current"><?= $item['label'] ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>
<?php } ?>

<!-- SEARCH BAR COMPONENT -->
<?php
function renderSearchBar($placeholder = "Rechercher...", $target = ".filterable-item") {
?>
    <div class="relative">
        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
        <input type="text" 
               class="search-input form-input pl-12 pr-6 py-4 text-lg w-full" 
               placeholder="<?= $placeholder ?>"
               data-target="<?= $target ?>">
    </div>
    <div class="search-results-count text-sm text-gray-600 mt-2" style="display: none;"></div>
<?php } ?>

<!-- MODAL COMPONENT -->
<?php
function renderModal($id, $title, $content, $size = 'md') {
?>
    <div id="<?= $id ?>" class="modal fixed inset-0 z-50 hidden">
        <div class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="modal-content bg-white rounded-2xl shadow-xl max-w-<?= $size ?> w-full max-h-screen overflow-y-auto">
                <div class="modal-header flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900"><?= $title ?></h2>
                    <button class="modal-close text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- LOADING SPINNER COMPONENT -->
<div class="loading-overlay fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50" style="display: none;">
    <div class="loading-spinner text-center">
        <div class="spinner w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-600 font-medium">Chargement...</p>
    </div>
</div>