<?php class Login extends Controller
{
    function dologin()
    {
        if (!Auth::check_auth()) {
            header('WWW-Authenticate: Digest realm="' . "DB" . '",qop="auth",nonce="' . uniqid()
                . '",opaque="' . "DB" . '"');
            header('HTTP/1.0 401 Unauthorized');
            die();
        } else {
            header('HTTP/1.0 200 Ok');
        }
    }

    function call()
    {
        $view = new VLogin;
        $view->render();
    }
}
