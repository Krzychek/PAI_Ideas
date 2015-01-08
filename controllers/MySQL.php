<?php
class MySQL {
	private $instance;

	private function __construct() {
		$db_host = "localhost";
		$db_name = "makeapp";
		$db_username = "root";
		$db_password = "kolosik";
		$this->connection = new mysqli($db_host,$db_username,$db_password,$db_name);
		mysqli_connect_errno() and die("Connect failed: %s\n" . $connection->connect_error);
	}

	public static function getInstance(){
		if (!$this->instance)
			$this->instance = new MySQL();
		return $this->instance;
	}
}
?>
