<?php
//error_reporting(E_ALL);

require __DIR__ . DIRECTORY_SEPARATOR .  'config.php';
require_once __DIR__ . DS . 'autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['action']) ? $_GET['action'] : 'All';

$ctrl = $ctrl . 'Controller';
$method = 'action' . $act;

if (!file_exists(__DIR__ . DS . 'controllers' . DS . $ctrl . '.php')) {
	throw new PageNotFoundException;
}
$controller = new $ctrl;

if (!method_exists($controller, $method)) {
	throw new PageNotFoundException;
}

try {
	$controller->$method();
}
catch (Exception $e) {
	$custom_except = new ExceptHundler($e);
	if ('PageNotFoundException' !== get_class($e)) { $custom_except->logExcept(); }

	$view = new Views();
	$view->error_code = $custom_except->getCustomExcaptCode();
	$view->error_msg = $custom_except->getCustomExceptMessage();
	$view->display('error.php');
}