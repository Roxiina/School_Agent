<?php
/**
 * COMPOSANTS ADMIN - Éléments réutilisables pour l'interface d'administration
 */

/**
 * Carte de statistique admin
 */
function admin_stat_card($title, $value, $icon, $color = 'red', $description = '') {
    return "
    <div class='admin-stat-card'>
        <div class='admin-stat-icon {$color}'>
            <i class='{$icon}'></i>
        </div>
        <div class='admin-stat-content'>
            <h3 class='admin-stat-number' data-count='{$value}'>{$value}</h3>
            <p>{$title}</p>
            " . ($description ? "<small>{$description}</small>" : "") . "
        </div>
    </div>";
}

/**
 * Bouton admin avec icône
 */
function admin_button($text, $href = '#', $type = 'primary', $icon = '', $attributes = []) {
    $class = "admin-btn admin-btn-{$type}";
    $icon_html = $icon ? "<i class='{$icon}'></i>" : '';
    $attrs = '';
    
    foreach ($attributes as $key => $value) {
        $attrs .= " {$key}='{$value}'";
    }
    
    if ($href === '#') {
        return "<button class='{$class}'{$attrs}>{$icon_html}{$text}</button>";
    } else {
        return "<a href='{$href}' class='{$class}'{$attrs}>{$icon_html}{$text}</a>";
    }
}

/**
 * Alerte admin
 */
function admin_alert($message, $type = 'info', $dismissible = true) {
    $dismiss_btn = $dismissible ? "<button class='admin-alert-close'><i class='fas fa-times'></i></button>" : '';
    $icon = [
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-exclamation-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle'
    ][$type] ?? 'fas fa-info-circle';
    
    return "
    <div class='admin-alert admin-alert-{$type}'>
        <i class='{$icon}'></i>
        <span>{$message}</span>
        {$dismiss_btn}
    </div>";
}

/**
 * Carte admin standard
 */
function admin_card($title, $content, $icon = '', $actions = []) {
    $icon_html = $icon ? "<i class='{$icon}'></i>" : '';
    $actions_html = '';
    
    if (!empty($actions)) {
        $actions_html = "<div class='admin-card-actions'>";
        foreach ($actions as $action) {
            $actions_html .= $action;
        }
        $actions_html .= "</div>";
    }
    
    return "
    <div class='admin-card'>
        <div class='admin-card-header'>
            <h3 class='admin-card-title'>{$icon_html}{$title}</h3>
            {$actions_html}
        </div>
        <div class='admin-card-body'>
            {$content}
        </div>
    </div>";
}

/**
 * Tableau admin avec tri
 */
function admin_table($headers, $data, $sortable = true) {
    $table_html = "<div class='admin-table-container'><table class='admin-table'>";
    
    // En-têtes
    $table_html .= "<thead><tr>";
    foreach ($headers as $key => $header) {
        $sort_attr = $sortable ? "data-sort='text'" : '';
        $table_html .= "<th {$sort_attr}>{$header}</th>";
    }
    $table_html .= "</tr></thead>";
    
    // Corps du tableau
    $table_html .= "<tbody>";
    foreach ($data as $row) {
        $table_html .= "<tr>";
        foreach (array_keys($headers) as $key) {
            $table_html .= "<td>" . ($row[$key] ?? '') . "</td>";
        }
        $table_html .= "</tr>";
    }
    $table_html .= "</tbody></table></div>";
    
    return $table_html;
}

/**
 * Formulaire admin
 */
function admin_form_group($label, $input, $required = false, $help_text = '') {
    $required_mark = $required ? "<span class='required'>*</span>" : '';
    $help_html = $help_text ? "<small class='admin-form-help'>{$help_text}</small>" : '';
    
    return "
    <div class='admin-form-group'>
        <label class='admin-form-label'>{$label}{$required_mark}</label>
        {$input}
        {$help_html}
    </div>";
}

/**
 * Input admin
 */
function admin_input($name, $value = '', $type = 'text', $attributes = []) {
    $attrs = "name='{$name}' id='{$name}' type='{$type}' value='{$value}'";
    
    foreach ($attributes as $key => $val) {
        $attrs .= " {$key}='{$val}'";
    }
    
    return "<input class='admin-form-input' {$attrs}>";
}

/**
 * Select admin
 */
function admin_select($name, $options, $selected = '', $attributes = []) {
    $attrs = "name='{$name}' id='{$name}'";
    
    foreach ($attributes as $key => $val) {
        $attrs .= " {$key}='{$val}'";
    }
    
    $select_html = "<select class='admin-form-select' {$attrs}>";
    
    foreach ($options as $value => $text) {
        $selected_attr = ($value == $selected) ? 'selected' : '';
        $select_html .= "<option value='{$value}' {$selected_attr}>{$text}</option>";
    }
    
    $select_html .= "</select>";
    
    return $select_html;
}

/**
 * Textarea admin
 */
function admin_textarea($name, $value = '', $attributes = []) {
    $attrs = "name='{$name}' id='{$name}'";
    
    foreach ($attributes as $key => $val) {
        $attrs .= " {$key}='{$val}'";
    }
    
    return "<textarea class='admin-form-textarea' {$attrs}>{$value}</textarea>";
}

/**
 * Badge de statut
 */
function admin_badge($text, $type = 'primary') {
    return "<span class='admin-badge admin-badge-{$type}'>{$text}</span>";
}

/**
 * Pagination admin
 */
function admin_pagination($current_page, $total_pages, $base_url) {
    if ($total_pages <= 1) return '';
    
    $pagination_html = "<div class='admin-pagination'>";
    
    // Bouton précédent
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $pagination_html .= "<a href='{$base_url}?page={$prev_page}' class='admin-pagination-btn'>
            <i class='fas fa-chevron-left'></i> Précédent
        </a>";
    }
    
    // Numéros de pages
    $start = max(1, $current_page - 2);
    $end = min($total_pages, $current_page + 2);
    
    if ($start > 1) {
        $pagination_html .= "<a href='{$base_url}?page=1' class='admin-pagination-num'>1</a>";
        if ($start > 2) {
            $pagination_html .= "<span class='admin-pagination-dots'>...</span>";
        }
    }
    
    for ($i = $start; $i <= $end; $i++) {
        $active_class = ($i == $current_page) ? 'active' : '';
        $pagination_html .= "<a href='{$base_url}?page={$i}' class='admin-pagination-num {$active_class}'>{$i}</a>";
    }
    
    if ($end < $total_pages) {
        if ($end < $total_pages - 1) {
            $pagination_html .= "<span class='admin-pagination-dots'>...</span>";
        }
        $pagination_html .= "<a href='{$base_url}?page={$total_pages}' class='admin-pagination-num'>{$total_pages}</a>";
    }
    
    // Bouton suivant
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $pagination_html .= "<a href='{$base_url}?page={$next_page}' class='admin-pagination-btn'>
            Suivant <i class='fas fa-chevron-right'></i>
        </a>";
    }
    
    $pagination_html .= "</div>";
    
    return $pagination_html;
}

/**
 * Breadcrumbs admin
 */
function admin_breadcrumbs($items) {
    $breadcrumbs_html = "<nav class='admin-breadcrumbs'>";
    
    $breadcrumbs_html .= "<a href='/admin'><i class='fas fa-home'></i> Administration</a>";
    
    foreach ($items as $item) {
        $breadcrumbs_html .= "<i class='fas fa-chevron-right'></i>";
        if (isset($item['url'])) {
            $breadcrumbs_html .= "<a href='{$item['url']}'>{$item['title']}</a>";
        } else {
            $breadcrumbs_html .= "<span class='current'>{$item['title']}</span>";
        }
    }
    
    $breadcrumbs_html .= "</nav>";
    
    return $breadcrumbs_html;
}

/**
 * Modal admin
 */
function admin_modal($id, $title, $content, $size = 'medium') {
    return "
    <div id='{$id}' class='admin-modal'>
        <div class='admin-modal-content admin-modal-{$size}'>
            <div class='admin-modal-header'>
                <h3 class='admin-modal-title'>{$title}</h3>
                <button class='admin-modal-close'>
                    <i class='fas fa-times'></i>
                </button>
            </div>
            <div class='admin-modal-body'>
                {$content}
            </div>
        </div>
    </div>";
}

/**
 * Graphique simple en CSS
 */
function admin_chart_bar($data, $max_value = null) {
    if ($max_value === null) {
        $max_value = max(array_values($data));
    }
    
    $chart_html = "<div class='admin-chart admin-chart-bar'>";
    
    foreach ($data as $label => $value) {
        $percentage = ($value / $max_value) * 100;
        $chart_html .= "
        <div class='admin-chart-item'>
            <div class='admin-chart-bar-container'>
                <div class='admin-chart-bar-fill' style='height: {$percentage}%' data-value='{$value}'></div>
            </div>
            <div class='admin-chart-label'>{$label}</div>
        </div>";
    }
    
    $chart_html .= "</div>";
    
    return $chart_html;
}

/**
 * Loader admin
 */
function admin_loader($message = 'Chargement...') {
    return "
    <div class='admin-loader'>
        <div class='admin-loader-content'>
            <div class='admin-spinner'></div>
            <p>{$message}</p>
        </div>
    </div>";
}

/**
 * Indicateur de statut
 */
function admin_status_indicator($status, $text = '') {
    $status_colors = [
        'online' => 'success',
        'offline' => 'error',
        'pending' => 'warning',
        'active' => 'success',
        'inactive' => 'error'
    ];
    
    $color = $status_colors[$status] ?? 'info';
    $text = $text ?: ucfirst($status);
    
    return "<span class='admin-status admin-status-{$color}'>
        <i class='fas fa-circle'></i>
        {$text}
    </span>";
}
?>