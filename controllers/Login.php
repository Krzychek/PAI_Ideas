<?php class Login
{
    function login()
    {
        if (!Auth::check_auth()) {
            header('WWW-Authenticate: Digest realm="' . "DB" . '",qop="auth",nonce="' . uniqid()
                . '",opaque="' . "DB" . '"');
            header('HTTP/1.0 401 Unauthorized');
            die();
        } else {
            echo "success";
        }
    }

    function call()
    {
        $view = new VLogin;
        $view->render();
    }

    function check()
    {
        // TODO
        echo true;
    }
} ?>
