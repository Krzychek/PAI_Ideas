<?php class Login {
	function __construct() {}
	function call() {
		$view = new VLogin;
		$view->render();
	}
	function login() {
		if (!Auth::check_auth()) {
			header('WWW-Authenticate: Digest realm="' . "DB" . '",qop="auth",nonce="' . uniqid()
					 . '",opaque="' . md5($realm) . '"');
			header('HTTP/1.0 401 Unauthorized');
			die();
		} else {
			echo "success";
		}
	}
	function check() {
		// TODO
		echo true;
	}
}?>
