<?php
// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

use SchoolAgent\Controllers\HomeController;

$home = new HomeController();
$home->index();
