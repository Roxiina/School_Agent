<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\SubjectModel;

class SubjectController
{
    private $model;

    public function __construct()
    {
        $this->model = new SubjectModel();
    }

    // Liste toutes les matières
    public function index()
    {
        $subjects = $this->model->getSubjects();
        require __DIR__ . '/../Views/subject/index.php';
    }

    // Formulaire création matière + traitement POST
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Création de la matière directement depuis le formulaire
            $this->model->createSubject($_POST);
            header('Location: /subject');
            exit;
        }

        // Sinon, on affiche le formulaire
        require __DIR__ . '/../Views/subject/create.php';
    }

    // Formulaire édition matière + traitement POST
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour directement depuis le formulaire
            $this->model->updateSubject($id, $_POST);
            header('Location: /subject');
            exit;
        }

        // Sinon, on affiche le formulaire avec les données de l'utilisateur
        $subject = $this->model->getSubject($id);
        require __DIR__ . '/../Views/subject/edit.php';
    }

    // Suppression matière
    public function delete($id)
    {
        $this->model->deleteSubject($id);
        header('Location: /subject');
        exit;
    }
}