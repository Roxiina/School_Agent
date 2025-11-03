<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\LevelModel;
use SchoolAgent\Config\Authenticator;

class LevelController {
    private $levelModel;

    public function __construct() {
        $this->levelModel = new LevelModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $levels = $this->levelModel->getLevels();
        require __DIR__ . '/../Views/level/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $level = $this->levelModel->getLevel($id);
        require __DIR__ . '/../Views/level/show.php';
    }
}