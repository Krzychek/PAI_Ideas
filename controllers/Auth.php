<?php class Auth {
	static function check_auth () {
		$connection = MySQL::getConnection();

		if (isset($_SERVER['PHP_AUTH_DIGEST'])):
			// parse auth data
			preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@',
								$_SERVER['PHP_AUTH_DIGEST'], $matches, PREG_SET_ORDER);
			foreach ($matches as $match) {
				$authAuth[$match[1]] = $match[2] ? $match[2] : $match[3];
			}
		else:
			return false;
		endif;

		$login = $connection->real_escape_string($authAuth['username']);
		$result = $connection->query("SELECT a1digest FROM `users`
			WHERE login = '{$login}'", MYSQLI_USE_RESULT);
		$A1 = $result->fetch_object()->a1digest;
		$A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$authAuth['uri']}");
		$validResponse = md5("{$A1}:{$authAuth['nonce']}:{$authAuth['nc']}:{$authAuth['cnonce']}:{$authAuth['qop']}:{$A2}");

		if ($authAuth['response']!=$validResponse) return false;
		return true;
	}
	static function require_auth() {
		if (!self::check_auth()):
			header("Location: http://www.example.com/");
			die();
		endif;
	}
}
?>
