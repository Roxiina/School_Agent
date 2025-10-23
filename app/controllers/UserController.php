<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\UserModel;

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    // Liste tous les utilisateurs
    public function index()
    {
        $users = $this->model->getUsers();
        require __DIR__ . '/../Views/users/index.php';
    }

    // Formulaire création utilisateur + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de l'utilisateur directement depuis le formulaire
            $this->model->createUser($_POST);
            header('Location: /users');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/users/create.php';
    }

    // Formulaire édition utilisateur + traitement POST
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateUser($id, $_POST);
            header('Location: /users');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $user = $this->model->getUser($id);
        require __DIR__ . '/../Views/users/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        $this->model->deleteUser($id);
        header('Location: /users');
        exit;
    }
}
