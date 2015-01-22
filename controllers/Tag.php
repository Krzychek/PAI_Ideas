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
        Router::error(404);
    }

    public function main($name)
    {
        Auth::check_auth();
        $data = MySQL::getConn()->query("SELECT * FROM ideas_overview WHERE tags regexp '(,|^){$name}(,|$)' ORDER BY ideas_overview.date ")->fetch_all(MYSQLI_ASSOC);
        $view = new VIdeas($data);
        $view->render();
    }
}
