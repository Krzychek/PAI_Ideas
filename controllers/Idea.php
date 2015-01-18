<?php class Idea extends Controller {

    function call($params)
    {
        Auth::check_auth();
        $id = $params[0];
        $conn = MySQL::getConnection();
        $data = $conn->query("SELECT * FROM ideas_details WHERE idea_id = '$id'")->fetch_assoc();
        $view = new VIdea($data);
        $view->render();
    }
}