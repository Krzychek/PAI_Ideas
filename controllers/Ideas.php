<?php class Ideas extends Controller
{
    function __construct()
    {
    }

    public function main()
    {
        Auth::check_auth();
        $conn = MySQL::getConnection();
        $data = $conn->query("SELECT * FROM ideas_overview")->fetch_all(MYSQLI_ASSOC);
        $view = new VIdeas($data);
        $view->render();
    }
}
