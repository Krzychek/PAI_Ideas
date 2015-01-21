<?php class Idea extends Controller
{
    function call($params)
    {
        Auth::check_auth();
        $id = $params[0];
        $conn = MySQL::getConnection();
        $idea_data = $conn->query("SELECT * FROM ideas_details WHERE idea_id = '$id'")->fetch_assoc();
        $comments_data = $conn->query("SELECT * FROM comments WHERE source_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        $view = new VIdea($idea_data, $comments_data);
        $view->render();
    }
}