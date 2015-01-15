<?php
class MySQL {
	private static $connection;
	static function getConnection() {
		if (is_null(self::$connection)) {
			$db_host="localhost";
			$db_name="makeapp";
			$db_username="root";
			$db_password="kolosik";
			self::$connection = new MySQLi($db_host, $db_username, $db_password, $db_name);
			self::$connection->connect_errno and
				die("Connect failed: %s\n" . $connection->connect_error);
		}
		return self::$connection;
	}
}
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
$controller->$action($router->getParams());
?>
