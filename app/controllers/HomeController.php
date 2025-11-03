<?php
namespace schoolAgent\Controllers;

use SchoolAgent\Models\HomeModel;
use SchoolAgent\Config\Authenticator;

class HomeController {
    
    // Page d'accueil publique
    public function index()
    {
        // Accessible à tous - pas de vérification de connexion
        require __DIR__ . '/../Views/welcome.php';
    }
    
    // Tableau de bord pour utilisateurs connectés
    public function dashboard()
    {
        // Vérifier si l'utilisateur est connecté
        Authenticator::requireLogin();
        
        // Rediriger vers le bon dashboard selon le rôle
        $userRole = Authenticator::getUserRole();
        
        switch ($userRole) {
            case 'etudiant':
                require __DIR__ . '/../Views/dashboard/student.php';
                break;
            case 'professeur':
                require __DIR__ . '/../Views/dashboard/teacher.php';
                break;
            case 'admin':
                require __DIR__ . '/../Views/dashboard/admin.php';
                break;
            default:
                // Fallback pour les rôles non reconnus
                require __DIR__ . '/../Views/dashboard/student.php';
                break;
        }
    }
}
