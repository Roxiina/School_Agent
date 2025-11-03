<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Config\Authenticator;
use SchoolAgent\Models\SubjectModel;
use SchoolAgent\Models\UserModel;

class AdminSubjectController
{
    private $model;

    public function __construct()
    {
        $this->model = new SubjectModel();

        // Vérification connexion
        if (!Authenticator::isLogged()) {
            Authenticator::setFlash("Vous devez être connecté pour accéder à l'administration.", "error");
            header("Location: /login");
            exit;
        }

        // Vérification rôle admin
        $currentUserId = Authenticator::getUserId();
        $userModel = new UserModel();
        $user = $userModel->getUser($currentUserId);

        if (!$user || $user['role'] !== 'admin') {
            Authenticator::setFlash("Accès refusé : vous n'êtes pas administrateur.", "error");
            header("Location: /home");
            exit;
        }
    }

    // Liste des matières
    public function index()
    {
        $subjects = $this->model->getSubjects();
        require __DIR__ . '/../../Views/admin/subject/index.php';
    }

    // Afficher une matière
    public function show($id)
    {
        $subject = $this->model->getSubject($id);
        if (!$subject) {
            http_response_code(404);
            echo "<h1>Matière introuvable</h1>";
            exit;
        }
        require __DIR__ . '/../../Views/admin/subject/show.php';
    }

    // Création matière
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createSubject($_POST);
            Authenticator::setFlash("Matière créée avec succès.", "success");
            header("Location: /admin/subject");
            exit;
        }
        require __DIR__ . '/../../Views/admin/subject/create.php';
    }

    // Édition matière
    public function edit($id)
    {
        $subject = $this->model->getSubject($id);
        if (!$subject) {
            http_response_code(404);
            echo "<h1>Matière introuvable</h1>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateSubject($id, $_POST);
            Authenticator::setFlash("Matière mise à jour.", "success");
            header("Location: /admin/subject");
            exit;
        }

        require __DIR__ . '/../../Views/admin/subject/edit.php';
    }

    // Suppression matière
    public function delete($id)
    {
        $this->model->deleteSubject($id);
        Authenticator::setFlash("Matière supprimée.", "info");
        header("Location: /admin/subject");
        exit;
    }
}
