<?php class Router
{
    private static $controllers = array(
        'Ideas', 'Register', 'Auth', 'Idea', 'Tag', 'Comment'
    );
    private $controller;
    private $params;

    function __construct($route)
    {
        $route = explode('/', $route);
        $this->controller = ucfirst(strtolower($route[0]));
        $this->params = array_slice($route, 1);
        if ($this->controller == "") {
            header('Location: ' . $GLOBALS['mainFolder'] . '/Ideas');
            die;
        }
        if (!in_array($this->controller, self::$controllers)) self::error(404);
    }

    static function error($code)
    {
        switch ($code) {
            case 404:
                header("HTTP/1.0 404 Not Found");
                echo "błąd 404!";
                die;
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
}
