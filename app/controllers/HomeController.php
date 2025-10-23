<?php
namespace schoolAgent\Controllers;

use SchoolAgent\Models\HomeModel;

class HomeController {
        public function index()
    {
        // Charger le modèle
        $model = new HomeModel();
        $message = $model->getMessage();

        // Charger la vue
        require __DIR__ . '/../Views/home.php';
    }
}
