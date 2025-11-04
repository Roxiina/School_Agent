<?php

namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Models\UserAgentModel;
use SchoolAgent\Models\UserModel;
use SchoolAgent\Models\AgentModel;

class AdminUserAgentController
{
    private $model;
    private $userModel;
    private $agentModel;

    public function __construct()
    {
        $this->model = new UserAgentModel();
        $this->userModel = new UserModel();
        $this->agentModel = new AgentModel();
    }

    // Liste des relations user-agent
    public function index()
    {
        $relations = $this->model->getAllRelations();
        require __DIR__ . '/../../views/admin/useragent/index.php';
    }

    // Formulaire création relation
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'] ?? null;
            $id_agent = $_POST['id_agent'] ?? null;

            if ($id_user && $id_agent) {
                $this->model->assignAgentToUser($id_user, $id_agent);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Agent attribué à l’utilisateur !'];
                header('Location: /admin/useragent');
                exit;
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Utilisateur et agent requis'];
                header('Location: /admin/useragent/create');
                exit;
            }
        }

        $users = $this->model->getAllUsers(); // méthode ajoutée dans UserAgentModel
        $agents = $this->agentModel->getAllAgents();
        require __DIR__ . '/../../views/admin/useragent/create.php';
    }

    // Supprimer relation
    public function delete()
    {
        $id_user = $_GET['id_user'] ?? null;
        $id_agent = $_GET['id_agent'] ?? null;

        if ($id_user && $id_agent) {
            $this->model->removeAgentFromUser($id_user, $id_agent);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Relation utilisateur-agent supprimée !'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Paramètres manquants pour supprimer la relation'];
        }

        header('Location: /admin/useragent');
        exit;
    }

    // Formulaire édition relation
    public function edit()
    {
        $id_user = $_GET['id_user'] ?? null;
        $id_agent = $_GET['id_agent'] ?? null;

        if (!$id_user || !$id_agent) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Paramètres manquants pour éditer la relation'];
            header('Location: /admin/useragent');
            exit;
            
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_id_agent = $_POST['id_agent'] ?? null;
            if ($new_id_agent) {
                $this->model->updateAgentForUser($id_user, $id_agent, $new_id_agent);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Relation mise à jour !'];
                header('Location: /admin/useragent');
                exit;
            }
        }

        $relation = $this->model->findRelation($id_user, $id_agent);
        $agents = $this->agentModel->getAllAgents();
        require __DIR__ . '/../../views/admin/useragent/edit.php';
    }
}
