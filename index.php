<?php
function _autoloader($class) {
	switch($class[0]) {
		case 'V': include 'views/'.$class.'.php'; break;
		default: include 'controllers/'.$class.'.php';
	}
}
spl_autoload_register('_autoloader');

require_once('Router.php');
$router = new Router($_GET['q']);
$controller = $router->getController();
$action = $router->getAction();
$controller->$action();
?>
