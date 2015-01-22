<?php class Tag extends Controller
{
    function __construct()
    {
    }

    public function call($params)
    {
        if ($params[0]) {
            $this->main($params[0]);
            return;
        }
        Router::error404();
    }

    public function main($name)
    {
        Auth::check_auth(); //todo filter nested tags
        $data = MySQL::getConn()->query("SELECT * FROM ideas_overview WHERE tags regexp '.*$name.*' ORDER BY ideas_overview.date ")->fetch_all(MYSQLI_ASSOC);
        $view = new VIdeas($data);
        $view->render();
    }
}
