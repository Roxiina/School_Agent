<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\HomeModel;

class HomeController {
    public function index()
    {
        // Charger la vue
        require __DIR__ . '/../Views/front/home.php';
    }
}
