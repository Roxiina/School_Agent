<?php
namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Models\AgentModel;

class AdminAgentController
{
    private $model;

    public function __construct()
    {
        $this->model = new AgentModel();
    }

    public function index()
    {
        $agents = $this->model->getAgents();
        require __DIR__ . '/../../Views/Admin/Agent/index.php';
    }

    public function show($id)
    {
        $agent = $this->model->getAgent($id);

        if (!$agent) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Agent introuvable'];
            header('Location: /admin/agent');
            exit;
        }

        require __DIR__ . '/../../Views/Admin/Agent/show.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createAgent($_POST);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Agent créé avec succès'];
            header('Location: /admin/agent');
            exit;
        }

        require __DIR__ . '/../../Views/Admin/Agent/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateAgent($id, $_POST);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Agent modifié avec succès'];
            header('Location: /admin/agent');
            exit;
        }

        $agent = $this->model->getAgent($id);
        require __DIR__ . '/../../Views/Admin/Agent/edit.php';
    }

    public function delete($id)
    {
        $this->model->deleteAgent($id);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Agent supprimé'];
        header('Location: /admin/agent');
        exit;
    }
}
