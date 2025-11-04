<?php

namespace SchoolAgent\Controllers\Admin;

use SchoolAgent\Models\UserLogModel;

class AdminUserLogController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserLogModel();
    }

    public function index()
    {
        $logs = $this->model->all();
        require __DIR__ . '/../../views/admin/userlog/index.php';
    }

    public function show(int $id)
    {
        $log = $this->model->find($id);
        if (!$log) {
            die("Log introuvable");
        }
        require __DIR__ . '/../../views/admin/userlog/show.php';
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Log supprimé'];
        header("Location: /admin/userlog");
        exit;
    }
}
