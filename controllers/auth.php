<?php
$db_host="localhost";
$db_name="makeapp";
$db_username="root";
$db_password="kolosik";
$connection = new mysqli($db_host,$db_username,$db_password,$db_name);
$connection->connect_errno and die("Connect failed: %s\n" . $connection->connect_error);
// TODO move to class

if (isset($_SERVER['PHP_AUTH_DIGEST'])):
	// parse auth data
	preg_match_all('@(\w+)=(?:(?:")([^"]+)"|([^\s,$]+))@',
						$_SERVER['PHP_AUTH_DIGEST'], $matches, PREG_SET_ORDER);
	foreach ($matches as $match) {
		$authAuth[$match[1]] = $match[2] ? $match[2] : $match[3];
	}
else: // TODO request login/forward to login, check realm, nonce
	header('WWW-Authenticate: Digest realm="' . "DB" .
		'",qop="auth",nonce="' . uniqid() . '",opaque="' .
		md5($realm) . '"');
	header('HTTP/1.0 401 Unauthorized');
	die();
endif;

$login = $connection->real_escape_string($authAuth['username']);
$result = $connection->query("SELECT a1digest FROM `users`
	WHERE login = '{$login}'", MYSQLI_USE_RESULT);
$A1 = $result->fetch_object()->a1digest;
$A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$authAuth['uri']}");
$validResponse = md5("{$A1}:{$authAuth['nonce']}:{$authAuth['nc']}:{$authAuth['cnonce']}:{$authAuth['qop']}:{$A2}");
if ($authAuth['response']!=$validResponse):
	echo "zły login lub hasło";
	die();
else:
	echo 'ok!';
endif;
?>
