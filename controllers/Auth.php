<?php class Auth extends Controller
{
    static function check_auth($perm = null)
    {

        if (!isset($_COOKIE['SESSION_ID'])) {
            header("Location: " . $GLOBALS['mainFolder'] . "/Auth/");
            die;
        }
        $connection = MySQL::getConn();

        $session_id = $connection->real_escape_string($_COOKIE['SESSION_ID']);
        $login = $connection->query("SELECT login FROM sessions WHERE session_id = '$session_id'")->fetch_row()[0];
        if (!$login) {
            header("Location: " . $GLOBALS['mainFolder'] . "/Auth/");
            die;
        }

        if ($perm) {
            if ('0' === $connection->query("SELECT check_perm('$login','$perm')")->fetch_row()[0]) {
                Router::error(403);
            }
        }
        $GLOBALS['login'] = $login;
    }

    public static function check_perm($perm)
    {
        $login = $GLOBALS['login'];
        return ('1' === MySQL::getConn()->query("SELECT check_perm('$login','$perm')")->fetch_row()[0]);
    }

    function dologin()
    {
        $conn = MySQL::getConn();
        $login = $conn->real_escape_string($_POST['login']);
        $auth = $conn->real_escape_string($_POST['auth']);
        if ("0" === $conn->query("SELECT dologin('$login', '$auth')")->fetch_row()[0]) {
            header('HTTP/1.1 500 Internal Server Booboo');
            die();
        }
        $expire = 9999;

        $conn->query("CALL `get_session_id`('$login', $expire, @session_id)");
        $session_id = $conn->query("SELECT @session_id")->fetch_row()[0];

        setcookie('SESSION_ID', $session_id, time() + $expire * 60,$GLOBALS['mainFolder'].'/');
        header('Content-Type: application/jsonf');
        echo json_encode(array("location" => $GLOBALS['mainFolder'] . "/Ideas/"));
    }

    function getnonce($param)
    {
        echo MySQL::getConn()->query("SELECT nonce FROM users WHERE login = '$param[0]'")->fetch_row()[0];
    }

    function logout()
    {
        if (isset($_COOKIE['SESSION_ID'])) {
            $conn = MySQL::getConn();
            $session_id = $conn->real_escape_string($_COOKIE['SESSION_ID']);
            $conn->query("DELETE FROM sessions WHERE session_id = '$session_id'");
        }
        header("Location: " . $GLOBALS['mainFolder'] . "/Auth/");
    }

    function main()
    {
        $view = new vLogin;
        $view->render();
    }
}