<?php class Idea extends Controller {

    function call()
    {
        $conn = MySQL::getConnection();
        $data = $conn->query("SELECT * FROM ideas_main_view")->fetch_all(MYSQLI_ASSOC);
        Auth::check_auth();
        $view = new VMain($data);
        $view->render();
    }
}