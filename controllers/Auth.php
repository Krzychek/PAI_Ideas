<?php class Auth extends Controller
{
    static function check_auth()
    {

        if (!isset($_COOKIE['SESSION_ID'])) {
            header("Location: " . $GLOBALS['mainFolder'] . "/Auth/");
            die;
        }
        $connection = MySQL::getConn();

        $session_id = $connection->real_escape_string($_COOKIE['SESSION_ID']);
        $GLOBALS['login'] = $connection->query("SELECT login FROM sessions WHERE session_id = '$session_id'")->fetch_field();
        if (!$GLOBALS['login']) {
            header("Location: " . $GLOBALS['mainFolder'] . "/Auth/");
            die;
        }
    }

    function dologin()
    {
        // TODO
    }

    function main()
    {
        $view = new VLogin;
        $view->render();
    }
}
