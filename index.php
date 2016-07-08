<?php

//error_reporting(E_ALL);

require __DIR__ . DIRECTORY_SEPARATOR .  'config.php';
require_once __DIR__ . DS . 'autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['action']) ? $_GET['action'] : 'All';
$ctrl = $ctrl . 'Controller';

$controller = new $ctrl;
$method = 'action' . $act;
$controller->$method();
