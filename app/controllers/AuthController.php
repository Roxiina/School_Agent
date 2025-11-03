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
            // Vérification que les champs existent et ne sont pas vides
            if (empty($_POST['email']) || empty($_POST['password'])) {
                Authenticator::setFlash('Veuillez remplir tous les champs.', 'error');
                require __DIR__ . '/../Views/auth/login.php';
                return;
            }

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = $this->model->getUserByEmail($email);

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                Authenticator::login($user['id_user']);
                Authenticator::setFlash('Connexion réussie ! Bienvenue.', 'success');
                header('Location: ?page=dashboard');
                exit;
            } else {
                Authenticator::setFlash('Email ou mot de passe incorrect.', 'error');
            }
        }

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout()
    {
        Authenticator::logout();
        header('Location: ?page=login');
        exit;
    }
}
