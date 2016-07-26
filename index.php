<?php
//error_reporting(E_ALL);
use Aplication\Exceptions\PageNotFound;
use Aplication\Core\View;
use Aplication\Exceptions\Hundler;


require __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
require_once __DIR__ . DS . 'autoload.php';


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathPart = explode('/', $path);

$ctrl_filename = !empty($pathPart[1]) ? ucfirst($pathPart[1]) : 'News';
$act = !empty($pathPart[2]) ? ucfirst($pathPart[2]) : 'All';
$id = !empty($pathPart[3]) ? (int)$pathPart[3] : null;

$_GET['id'] = $id;

$ctrl = 'Aplication\\Controllers\\' . $ctrl_filename;    //get a controller name in namespaces
$method = 'action' . $act;


try {
	$mail = new \PHPMailer\PHPMailer\PHPMailer();
	$controller = new $ctrl;

	if (!method_exists($controller, $method)) { throw new PageNotFound; }

	$controller->$method();
}
catch (Exception $e) {
	$custom_except = new Hundler($e);
	if ('Aplication\Exceptions\PageNotFound' !== get_class($e)) { $custom_except->logExcept(); }

	$view = new View();
	$view->error_code = $custom_except->getCustomExcaptCode();
	$view->error_msg = $custom_except->getCustomExceptMessage();
	$view->display('error.php');
}