<?php class Comment extends Controller
{
    function add($param)
    {
        Auth::check_auth();
        $conn = MySQL::getConn();
        $source_id = $conn->real_escape_string($param[0]);
        $comment = $conn->real_escape_string(htmlspecialchars($_POST['content']));
        $login = $GLOBALS['login'];

        $conn->query("CALL `add_comment`('$comment','$source_id','$login')");

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}