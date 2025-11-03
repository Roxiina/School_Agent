<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Config\Authenticator;

class UserController {
    public function index() {
        Authenticator::requireLogin();
        require __DIR__ . '/../Views/user/index.php';
    }

    public function profile() {
        Authenticator::requireLogin();
        require __DIR__ . '/../Views/user/show.php';
    }
}