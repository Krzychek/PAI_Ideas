<?php class Main extends Controller
{
    function __construct()
    {
    }

    function call()
    {
        Auth::check_auth();
        $conn = MySQL::getConnection();
        $data = $conn->query("SELECT * FROM ideas_overview")->fetch_all(MYSQLI_ASSOC);
        $view = new VMain($data);
        $view->render();
    }
}
