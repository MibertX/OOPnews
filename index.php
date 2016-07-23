<?php
//error_reporting(E_ALL);

require __DIR__ . DIRECTORY_SEPARATOR .  'config.php';
require_once __DIR__ . DS . 'autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathPart = explode('/', $path);

$ctrl = !empty($pathPart[1]) ? ucfirst($pathPart[1]) : 'News';
$act = !empty($pathPart[2]) ? ucfirst($pathPart[2]) : 'All';
$id = !empty($pathPart[3]) ? ucfirst($pathPart[3]) : null;

$_GET['id'] = $pathPart[3];

try {
	$ctrl = $ctrl . 'Controller';
	$method = 'action' . $act;

	if (!file_exists(__DIR__ . DS . 'controllers' . DS . $ctrl . '.php') || !method_exists($ctrl, $method)) {
		throw new PageNotFoundException;
	}

	$controller = new $ctrl;
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