<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\LevelModel;
use SchoolAgent\Models\UserModel; // pour récupérer le user courant

class AdminLevelController
{
    private $model;

    public function __construct()
    {

        $this->model = new LevelModel();

        // Vérifier que l'utilisateur est connecté toto
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
        }

        // Vérifier que l'utilisateur est admin
        $userModel = new UserModel();
        $currentUserId = Authenticator::getUserId();
        $user = $userModel->getUser($currentUserId);

        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /home");
            exit;
        }
    }

    // Liste des niveaux
    public function index()
    {
        $levels = $this->model->getLevels();
        require __DIR__ . '/../../Views/admin/level/index.php';
    }

    // Afficher un niveau
    public function show($id)
    {
        $level = $this->model->getLevel($id);
        if (!$level) {
            http_response_code(404);
            echo "<h1>Niveau introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/level/show.php';
    }

    // Create
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createLevel($_POST);
            Authenticator::setFlash("Niveau créé avec succès.", "success");
            header('Location: /admin/level');
            exit;
        }
        require __DIR__ . '/../../Views/admin/level/create.php';
    }

    // Edit
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateLevel($id, $_POST);
            Authenticator::setFlash("Niveau mis à jour.", "success");
            header('Location: /admin/level');
            exit;
        }

        $level = $this->model->getLevel($id);
        if (!$level) {
            http_response_code(404);
            echo "<h1>Niveau introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../../Views/admin/level/edit.php';
    }

    // Delete
    public function delete($id)
    {
        $this->model->deleteLevel($id);
        Authenticator::setFlash("Niveau supprimé.", "info");
        header('Location: /admin/level');
        exit;
    }
}
