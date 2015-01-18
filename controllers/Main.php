<?php class Main extends Controller
{
    function __construct()
    {
    }

    function call()
    {
        $conn = MySQL::getConnection();
        $data = $conn->query("SELECT * FROM ideas")->fetch_all(MYSQLI_ASSOC);
        Auth::check_auth();
        $view = new VMain($data);
        $view->render();
    }
}
