<?php class Vote extends Controller
{
    function up($params)
    {
        Auth::check_auth('vote');
        $login = $GLOBALS['login'];
        MySQL::getConn()->query("INSERT INTO votes (voter_login, idea_id, up) VALUES('$login', $params[0], 1) " .
            "ON DUPLICATE KEY UPDATE up=1");
        echo "INSERT INTO votes (voter_login, idea_id, up) VALUES('$login', $params[0], 1) " .
            "ON DUPLICATE KEY UPDATE up=1";

    }

    function down($params)
    {
        Auth::check_auth('vote');
        $login = $GLOBALS['login'];
        MySQL::getConn()->query("INSERT INTO votes (voter_login, idea_id, up) VALUES('$login', $params[0], 0) " .
            "ON DUPLICATE KEY UPDATE up=0");
    }

    function unvote($params)
    {
        Auth::check_auth();
        $login = $GLOBALS['login'];
        MySQL::getConn()->query("DELETE FROM votes WHERE idea_id = $params[0] AND voter_login = '$login'");
    }
}