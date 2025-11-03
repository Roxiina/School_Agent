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

                if ($user && (password_verify($password, $user['mot_de_passe']) || md5($password) === $user['mot_de_passe'])) {
                    // Si c'est encore MD5, le convertir en password_hash
                    if (md5($password) === $user['mot_de_passe']) {
                        $newHash = password_hash($password, PASSWORD_DEFAULT);
                        $this->model->updatePassword($user['id_user'], $newHash);
                    }
                    
                    Authenticator::login($user['id_user']);
                    
                    // Redirection basée sur le rôle
                    if ($user['role'] === 'admin') {
                        header('Location: ?page=admin');
                    } else {
                        header('Location: ?page=home');
                    }
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
