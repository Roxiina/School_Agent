<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Controllers\UserController;

$controller = new UserController();
$controller->index();
