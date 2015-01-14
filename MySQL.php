<?php
class MySQL {
	private static $connection;
	static function getConnection() {
		if (is_null(self::$connection)) {
			$db_host="localhost";
			$db_name="makeapp";
			$db_username="root";
			$db_password="kolosik";
			self::$connection = new mysqli($db_host,$db_username,$db_password,$db_name);
			self::$connection->connect_errno and
				die("Connect failed: %s\n" . $connection->connect_error);
		}
		return self::$connection;
	}
}
?>
