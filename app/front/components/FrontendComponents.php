<?php
/**
 * Composants frontend réutilisables pour School Agent
 */

class FrontendComponents {
    
    /**
     * Génère un header HTML complet
     */
    public static function renderHeader($title = "School Agent", $currentPage = "") {
        return '
        <header>
            <div class="container">
                <div class="header-content">
                    <a href="/public/" class="logo">🎓 School Agent</a>
                    <nav>
                        <ul class="nav-menu">
                            <li><a href="/public/" class="' . ($currentPage === 'home' ? 'active' : '') . '">Accueil</a></li>
                            <li><a href="/public/?page=conversation" class="' . ($currentPage === 'conversation' ? 'active' : '') . '">Conversations</a></li>
                            <li><a href="/public/?page=subject" class="' . ($currentPage === 'subject' ? 'active' : '') . '">Matières</a></li>
                            <li><a href="/public/?page=user" class="' . ($currentPage === 'user' ? 'active' : '') . '">Utilisateurs</a></li>
                            <li><a href="/public/?page=level" class="' . ($currentPage === 'level' ? 'active' : '') . '">Niveaux</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>';
    }
    
    /**
     * Génère un footer HTML
     */
    public static function renderFooter() {
        $currentYear = date('Y');
        return "
        <footer>
            <div class=\"container\">
                <p>&copy; {$currentYear} School Agent - Assistant IA pour l'éducation</p>
                <p>Développé avec ❤️ pour l'apprentissage</p>
            </div>
        </footer>";
    }
    
    /**
     * Génère les liens CSS et JS
     */
    public static function renderAssets() {
        return '
        <link rel="stylesheet" href="/app/front/css/style.css">
        <script src="/app/front/js/app.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">';
    }
    
    /**
     * Génère une carte d'agent IA
     */
    public static function renderAgentCard($agent) {
        $avatar = $agent['avatar'] ?? 'default.png';
        $avatarUrl = "/app/front/images/{$avatar}";
        
        return "
        <div class=\"agent-card\" data-agent-id=\"{$agent['id_agent']}\">
            <div class=\"agent-avatar\">
                <img src=\"{$avatarUrl}\" alt=\"{$agent['nom']}\" style=\"width: 100%; height: 100%; border-radius: 50%; object-fit: cover;\">
            </div>
            <h3 class=\"agent-name\">{$agent['nom']}</h3>
            <p class=\"agent-description\">{$agent['description']}</p>
            <div class=\"agent-actions\">
                <a href=\"/public/?page=conversation&agent={$agent['id_agent']}\" class=\"btn btn-primary\">Discuter</a>
            </div>
        </div>";
    }
    
    /**
     * Génère un formulaire stylisé
     */
    public static function renderForm($config) {
        $action = $config['action'] ?? '';
        $method = $config['method'] ?? 'POST';
        $title = $config['title'] ?? 'Formulaire';
        $fields = $config['fields'] ?? [];
        $submitText = $config['submit'] ?? 'Envoyer';
        
        $html = "<form action=\"{$action}\" method=\"{$method}\" class=\"form\">";
        $html .= "<div class=\"card-header\"><h2 class=\"card-title\">{$title}</h2></div>";
        
        foreach ($fields as $field) {
            $html .= self::renderFormField($field);
        }
        
        $html .= "<div class=\"form-group\">";
        $html .= "<button type=\"submit\" class=\"btn btn-primary\">{$submitText}</button>";
        $html .= "</div>";
        $html .= "</form>";
        
        return $html;
    }
    
    /**
     * Génère un champ de formulaire
     */
    public static function renderFormField($field) {
        $type = $field['type'] ?? 'text';
        $name = $field['name'] ?? '';
        $label = $field['label'] ?? '';
        $value = $field['value'] ?? '';
        $required = $field['required'] ?? false;
        $placeholder = $field['placeholder'] ?? '';
        $options = $field['options'] ?? [];
        
        $html = "<div class=\"form-group\">";
        
        if ($label) {
            $html .= "<label for=\"{$name}\" class=\"form-label\">{$label}</label>";
        }
        
        switch ($type) {
            case 'textarea':
                $html .= "<textarea name=\"{$name}\" id=\"{$name}\" class=\"form-input form-textarea\" placeholder=\"{$placeholder}\" " . ($required ? 'required' : '') . ">{$value}</textarea>";
                break;
            
            case 'select':
                $html .= "<select name=\"{$name}\" id=\"{$name}\" class=\"form-input\" " . ($required ? 'required' : '') . ">";
                $html .= "<option value=\"\">Sélectionner...</option>";
                foreach ($options as $optValue => $optLabel) {
                    $selected = ($value == $optValue) ? 'selected' : '';
                    $html .= "<option value=\"{$optValue}\" {$selected}>{$optLabel}</option>";
                }
                $html .= "</select>";
                break;
            
            case 'password':
                $html .= "<input type=\"password\" name=\"{$name}\" id=\"{$name}\" class=\"form-input\" placeholder=\"{$placeholder}\" " . ($required ? 'required' : '') . ">";
                break;
            
            default:
                $html .= "<input type=\"{$type}\" name=\"{$name}\" id=\"{$name}\" class=\"form-input\" value=\"{$value}\" placeholder=\"{$placeholder}\" " . ($required ? 'required' : '') . ">";
        }
        
        $html .= "</div>";
        
        return $html;
    }
    
    /**
     * Génère une table stylisée
     */
    public static function renderTable($data, $headers, $actions = []) {
        $html = "<div class=\"table-container\">";
        $html .= "<table class=\"table\">";
        
        // En-têtes
        $html .= "<thead><tr>";
        foreach ($headers as $key => $header) {
            $html .= "<th data-sort=\"{$key}\">{$header}</th>";
        }
        if (!empty($actions)) {
            $html .= "<th>Actions</th>";
        }
        $html .= "</tr></thead>";
        
        // Données
        $html .= "<tbody>";
        foreach ($data as $row) {
            $html .= "<tr>";
            foreach ($headers as $key => $header) {
                $value = $row[$key] ?? '';
                $html .= "<td>{$value}</td>";
            }
            
            if (!empty($actions)) {
                $html .= "<td>";
                foreach ($actions as $action) {
                    $url = str_replace('{id}', $row['id'] ?? '', $action['url']);
                    $class = $action['class'] ?? 'btn btn-secondary';
                    $html .= "<a href=\"{$url}\" class=\"{$class}\">{$action['label']}</a> ";
                }
                $html .= "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        
        $html .= "</table>";
        $html .= "</div>";
        
        return $html;
    }
    
    /**
     * Génère une notification
     */
    public static function renderAlert($message, $type = 'info') {
        return "<div class=\"alert alert-{$type}\">{$message}</div>";
    }
    
    /**
     * Génère une grille d'éléments
     */
    public static function renderGrid($items, $callback, $columns = 3) {
        $html = "<div class=\"grid grid-{$columns}\">";
        
        foreach ($items as $item) {
            $html .= $callback($item);
        }
        
        $html .= "</div>";
        
        return $html;
    }
    
    /**
     * Génère un chat container
     */
    public static function renderChatContainer($messages = []) {
        $html = "<div class=\"chat-container\">";
        
        foreach ($messages as $message) {
            $type = $message['type'] ?? 'agent';
            $content = $message['content'] ?? '';
            $time = $message['time'] ?? date('H:i');
            
            $html .= "<div class=\"message {$type}\">";
            $html .= "<div class=\"message-content\">{$content}</div>";
            $html .= "<div class=\"message-time\">{$time}</div>";
            $html .= "</div>";
        }
        
        $html .= "</div>";
        
        // Formulaire de chat
        $html .= "<form id=\"chat-form\" class=\"chat-form\">";
        $html .= "<div class=\"form-group\" style=\"margin-bottom: 0;\">";
        $html .= "<div style=\"display: flex; gap: 1rem;\">";
        $html .= "<input type=\"text\" id=\"message-input\" class=\"form-input\" placeholder=\"Tapez votre message...\" style=\"flex: 1;\" required>";
        $html .= "<button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</form>";
        
        return $html;
    }
    
    /**
     * Génère une page complète avec layout
     */
    public static function renderPage($content, $title = "School Agent", $currentPage = "") {
        return "<!DOCTYPE html>
        <html lang=\"fr\">
        <head>
            <title>{$title}</title>
            " . self::renderAssets() . "
        </head>
        <body>
            " . self::renderHeader($title, $currentPage) . "
            
            <main>
                <div class=\"container\">
                    {$content}
                </div>
            </main>
            
            " . self::renderFooter() . "
        </body>
        </html>";
    }
}
?>