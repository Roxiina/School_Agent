<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\UserModel;
use SchoolAgent\Config\Authenticator;

class AuthController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['mot_de_passe'];

            $user = $this->model->getUserByEmail($email);

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                Authenticator::login($user['id_user']);
                header('Location: /home');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        require __DIR__ . '/../Views/front/login.php';
    }

    public function logout()
    {
        Authenticator::logout();
        header('Location: /login');
        exit;
    }
}
