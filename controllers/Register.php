<?php class Register extends Controller
{
    function post()
    {
        $connection = MySQL::getConn();
        $A1 = $connection->real_escape_string($_POST['a1']);
        $login = $connection->real_escape_string($_POST['login']);
        if (preg_match('/^[a-zA-Z]+[0-9]*$/', $login)) {
            if ($connection->query("INSERT INTO `users`(login, a1) VALUES ('$login', '$A1');")) {
                // TODO redirect to successfull register
            }
        }
        http_response_code(409);
    }

    function main()
    {
        $view = new vRegister;
        $view->render();
    }

    function check($params)
    {
        $connection = MySQL::getConn();
        $login = $params[0];
        if (strlen($login) > 2 && !$connection->query("SELECT * FROM users WHERE login = '$login'")->num_rows)
            echo 'available';
    }
}
