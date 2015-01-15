<?php class Register {
	function __construct() {
		require_once('auth.php');
	}
	function call() {
		$view = new VRegister;
		$view->render();
	}
	function register() {
		// TODO check if exist
		$connection = MySQL::getConnection();
		$A1 = $_POST['A1'];
		$result = $connection->query("INSERT INTO `users`(id, digesta1)
		VALUES ('{$login}', '{$A1}';");
	}
	function check() {
		// TODO
		echo true;
	}
}?>
