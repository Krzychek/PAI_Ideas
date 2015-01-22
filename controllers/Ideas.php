<?php class Ideas extends Controller
{
    function __construct()
    {
    }

    public function main()
    {
        Auth::check_auth();
        $conn = MySQL::getConn();
        $data = $conn->query("SELECT * FROM ideas_overview ORDER BY ideas_overview.date ")->fetch_all(MYSQLI_ASSOC);
        $view = new VIdeas($data);
        $view->render();
    }
}
