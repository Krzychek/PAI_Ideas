<?php class Router {
	private static $controllers = array(
		'Test',
	);
	private $controller;
	private $action;
	private $params;
	function __construct($route) {
		if($route) {
			$route = explode('/',$route);
			switch (count($route)) {
				case 2:
					$this->controller = $route[0];
					$this->action = "call";
					$this->params = [];
					break;
				case 3:
					$this->controller = $route[0];
					$this->action = $route[1];
					$this->params = [];
					break;
				default:
					$this->controller = $route[0];
					$this->action = $route[1];
					$this->params = array_slice($route,2);
			}
		} else {
			$this->controller = "main";
			$this->action = "call";
			$this->params = [];
		}
	}
	function getController() {
		if (in_array($this->controller, self::$controllers)) {
			return new $this->controller;
		}
	}
	function getAction() {
		return $this->action;
	}
	function getParams() {
		return $this->params;
	}
} ?>
