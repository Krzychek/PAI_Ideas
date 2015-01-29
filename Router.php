<?php class Router
{
    private static $controllers = ['Ideas', 'Register', 'Auth', 'Idea', 'Tag', 'Comment', 'Vote', 'Users'];
    private $controller;
    private $params;

    function __construct($route)
    {
        $route = explode('/', $route);
        $this->controller = ucfirst(strtolower($route[0]));
        $this->params = array_slice($route, 1);
        if ($this->controller == "") {
            header('Location: ' . $GLOBALS['mainFolder'] . '/ideas');
            die;
        }
        if (!in_array($this->controller, self::$controllers)) self::error(404);
    }

    static function error($code)
    {
        http_response_code($code);
        switch ($code) {
            case 404:
                echo "błędny adres!";
                break;
            case 403:
                echo "nie masz uprawnień!";
                break;
            default:
                http_response_code(404);
        }
        die;
    }

    function getController()
    {
        return new $this->controller;
    }

    function getParams()
    {
        return $this->params;
    }
}
