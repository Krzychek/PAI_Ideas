<?php class Users extends Controller
{
    function manage()
    {
        Auth::check_auth('full');
        $conn = MySQL::getConn();
        $result = $conn->query("SELECT login, points FROM users")->fetch_all(MYSQLI_ASSOC);
        (new vAdminUsers($result))->render();

    }

    function rmuser($param)
    {
        Auth::check_auth('full');
        $conn = MySQL::getConn();
        $login = $conn->real_escape_string($param[0]);
        // check permissions
        $conn->query("DELETE FROM users WHERE login = '$login'");
    }

    function userideas($param)
    {
        Auth::check_auth();
        $login = $param[0];
        $data = MySQL::getConn()->query("SELECT * FROM ideas_overview WHERE login = '$login' ORDER BY ideas_overview.date;")->fetch_all(MYSQLI_ASSOC);
        $view = new vIdeas($data);
        $view->render();
    }

    function resetrep($param)
    {
        Auth::check_auth('full');
        $login = $param[0];
        MySQL::getConn()->query("UPDATE users SET points = (SELECT sum(ideas_overview.score) " .
            "FROM ideas_overview WHERE login = '$login' GROUP BY login);")->fetch_all(MYSQLI_ASSOC);
        header("Location: " . $_SERVER['HTTP_REFERER']);


    }
}