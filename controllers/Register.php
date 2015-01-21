<?php class Register extends Controller
{
    function register()
    {
        $connection = MySQL::getConnection();
        $A1 = $connection->real_escape_string($_POST['A1']);
        $login = $connection->real_escape_string($_POST['login']);
        if ($connection->query("INSERT INTO `users`(login, a1digest) VALUES ('$login', '$A1';")) {
            // TODO if exist
        }
    }

    function main()
    {
        $view = new VRegister;
        $view->render();
    }

    function check($params)
    {
        $connection = MySQL::getConnection();
        $login = $params[0];
        if (strlen($login) > 2 && !$connection->query("SELECT * FROM users WHERE login = '$login'")->num_rows)
            echo 'available';
    }
}
