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
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? $_POST['mot_de_passe'] ?? null;

            if (!$email || !$password) {
                $error = "Email et mot de passe requis.";
            } else {
                $user = $this->model->getUserByEmail($email);

                if ($user && password_verify($password, $user['mot_de_passe'])) {
                    Authenticator::login($user['id_user']);
                    header('Location: ?page=home');
                    exit;
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout()
    {
        Authenticator::logout();
        header('Location: /login');
        exit;
    }
}
