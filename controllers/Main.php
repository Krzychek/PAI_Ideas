<?php class Main {
	function __construct() {
		Auth::require_auth();
	}
	function call() {
		$view = new VMain;
		$view->render();
	}
}?>
