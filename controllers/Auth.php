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
			header('WWW-Authenticate: Digest realm="' . "DB" . '",qop="auth",nonce="' . uniqid()
				. '",opaque="' . "DB" . '"');
			die();
		endif;

		/** @noinspection PhpUndefinedVariableInspection */
		$login = $connection->real_escape_string($authAuth['username']);
		$result = $connection->query("SELECT a1digest FROM `users` WHERE login = '{$login}'", MYSQLI_USE_RESULT);
		$A1 = $result->fetch_object()->a1digest;
		$A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$authAuth['uri']}");
		$validResponse = md5("{$A1}:{$authAuth['nonce']}:{$authAuth['nc']}:{$authAuth['cnonce']}:{$authAuth['qop']}:{$A2}");
		if ($authAuth['response']!=$validResponse){
			header('WWW-Authenticate: Digest realm="' . "DB" . '",qop="auth",nonce="' . uniqid()
				. '",opaque="' . "DB" . '"');
			header('HTTP/1.0 401 Unauthorized');
			die();
		}
		$GLOBALS['user_id'] = $login;
	}
}
