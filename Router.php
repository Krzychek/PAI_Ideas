<?php class Router {
	private static $controllers = array(
		'Main','Register','Auth','Idea'
	);
	private $controller;
	private $params;

	function __construct($route) {
		$route = explode('/',$route);
		$this->controller = ucfirst(strtolower($route[0]));
		$this->params = array_slice($route,1);
		if (strlen($this->controller) < 2 && !in_array($this->controller, self::$controllers)) {
			header('Location: ' . '/notFound404');
			exit;
		}
	}
	function getController() { return new $this->controller; }
	function getParams() { return $this->params; }
}
