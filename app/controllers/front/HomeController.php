<?php
namespace SchoolAgent\Controllers\front;

use SchoolAgent\Models\HomeModel;
use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\UserModel;

class HomeController {
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        $isLogged = Authenticator::isLogged();
        $user = null;
        
        if ($isLogged) {
            $userModel = new UserModel();
            $user = $userModel->getUser(Authenticator::getUserId());
        }
        
        // Charger la vue avec les variables
        require __DIR__ . '/../../Views/front/home.php';
    }
}
