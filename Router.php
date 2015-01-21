<?php class Router
{
    private static $controllers = array(
        'Ideas', 'Register', 'Auth', 'Idea'
    );
    private $controller;
    private $params;

    function __construct($route)
    {
        $route = explode('/', $route);
        $this->controller = ucfirst(strtolower($route[0]));
        $this->params = array_slice($route, 1);
        if (!in_array($this->controller, self::$controllers)) {
            self::error404();
        }
    }

    function getController()
    {
        return new $this->controller;
    }

    function getParams()
    {
        return $this->params;
    }

    static function error404()
    {
        header("HTTP/1.0 404 Not Found");
        echo "błąd 404!";
        exit;
    }
}
