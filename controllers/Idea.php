<?php class Idea extends Controller
{
    function call($params)
    {
        Auth::check_auth();
        $id = $params[0];
        $conn = MySQL::getConnection();
        $idea_data = $conn->query("SELECT * FROM ideas_details WHERE idea_id = '$id'")->fetch_assoc();
        $view = new VIdea($idea_data, $this->getComments($id));
        $view->render();
    }

    private function getComments($id)
    {
        $result = MySQL::getConnection()->query("SELECT * FROM comments WHERE source_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        foreach ($result as &$comment) {
            $comment['subComments'] = $this->getComments($comment['comment_id']);
        }
        return $result;
    }
}