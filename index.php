<?php
//if ($_SERVER["HTTPS"] != "on") {
//    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//    exit();
//}
$GLOBALS['mainFolder'] = '/makeapp';

class MySQL
{
    private static $connection;

    static function getConn()
    {
        if (is_null(self::$connection)) {
            $db_host = "localhost";
            $db_name = "makeapp";
            $db_username = "makeapp";
            $db_password = "kolosik";
            self::$connection = new MySQLi($db_host, $db_username, $db_password, $db_name);
            self::$connection->connect_errno and die("Connect failed: %s\n" . self::$connection->connect_error);
        }
        return self::$connection;
    }
}

function _autoloader($class)
{
    switch ($class[0]) {
        case 'V':
            /** @noinspection PhpIncludeInspection */
            include 'views/' . $class . '.php';
            break;
        default:
            /** @noinspection PhpIncludeInspection */
            include 'controllers/' . $class . '.php';
    }
}

spl_autoload_register('_autoloader');

require_once('Router.php');
$router = new Router($_GET['q']);
$controller = $router->getController();
/** @noinspection PhpUndefinedMethodInspection */
$controller->call($router->getParams());
