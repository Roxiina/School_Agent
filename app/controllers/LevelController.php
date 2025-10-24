<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\LevelModel;

class LevelController
{
    private $model;

    public function __construct()
    {
        $this->model = new LevelModel();
    }

    // Liste tous les niveaux
    public function index()
    {
        $levels = $this->model->getLevels();
        require __DIR__ . '/../Views/level/index.php';
    }

    // Afficher le niveau
    public function show($id)
    {
        $level = $this->model->getLevel($id);

        if (!$level) {
            http_response_code(404);
            echo "<h1>Niveau introuvable</h1>";
            exit;
        }

        require __DIR__ . '/../Views/level/show.php';
    }


    // Formulaire création niveau + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création d'un niveau directement depuis le formulaire
            $this->model->createLevel($_POST);
            header('Location: /level');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/level/create.php';
    }

    // Formulaire édition niveau + traitement POST
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateLevel($id, $_POST);
            header('Location: /level');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de niveau
        $level = $this->model->getLevel($id);
        require __DIR__ . '/../Views/level/edit.php';
    }

    // Suppression niveau
    public function delete($id)
    {
        $this->model->deleteLevel($id);
        header('Location: /level');
        exit;
    }
}