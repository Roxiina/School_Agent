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
        require __DIR__ . '/../Views/user/index.php';
    }

    // Afficher le profil d’un utilisateur
    public function show($id)
    {
        $user = $this->model->getUser($id);

        if (!$user) {
            http_response_code(404);
            echo "<h1>Utilisateur introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/user/show.php';
    }

    // Formulaire création utilisateur + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de l'utilisateur directement depuis le formulaire
            $this->model->createUser($_POST);
            header('Location: /user');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/user/create.php';
    }

    // Formulaire édition utilisateur + traitement POST
    
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateUser($id, $_POST);
            header('Location: /user');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $user = $this->model->getUser($id);
        require __DIR__ . '/../Views/user/edit.php';
    }

    // Suppression utilisateur
    public function delete($id)
    {
        $this->model->deleteUser($id);
        header('Location: /user');
        exit;
    }
}
