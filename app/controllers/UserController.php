<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\UserModel;

class UserController
{
    // http://localhost:8000/?page=users
    // via le .htaccess => http://localhost:8000/users
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        require __DIR__ . '/../Views/users/index.php';
    }
}
