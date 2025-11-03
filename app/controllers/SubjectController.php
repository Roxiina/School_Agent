<?php
namespace SchoolAgent\Controllers;

use SchoolAgent\Models\SubjectModel;
use SchoolAgent\Config\Authenticator;

class SubjectController {
    private $subjectModel;

    public function __construct() {
        $this->subjectModel = new SubjectModel();
    }

    public function index() {
        Authenticator::requireLogin();
        $subjects = $this->subjectModel->getSubjects();
        require __DIR__ . '/../Views/subject/index.php';
    }

    public function show($id) {
        Authenticator::requireLogin();
        $subject = $this->subjectModel->getSubject($id);
        require __DIR__ . '/../Views/subject/show.php';
    }
}