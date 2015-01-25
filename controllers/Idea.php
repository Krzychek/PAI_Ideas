<?php class Idea extends Controller
{
    function call($params)
    {
        Auth::check_auth();
        if ($params[0] === "new") {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    (new VAddIdea())->render();
                    break;
                case 'POST':
                    $this->addNew();
                    break;
            }
        } else {
            $id = $params[0];
            $conn = MySQL::getConn();
            $idea_data = $conn->query("SELECT * FROM ideas_details WHERE idea_id = '$id'")->fetch_assoc();
            $view = new VIdea($idea_data, $this->getComments($id));
            $view->render();
        }
    }

    private function addNew()
    {
        if (!isset($_POST['title'], $_POST['tags'], $_POST['content'])) {
            http_response_code(400);
            die;
        }
        $conn = MySQL::getConn();
        $conn->begin_transaction();
        $title = $conn->real_escape_string($_POST['title']);
        $tags = $conn->real_escape_string(str_replace(' ', '', strtoupper($_POST['tags'])));
        $content = $conn->real_escape_string($_POST['content']);
        $login = $GLOBALS['login'];

        $conn->query("CALL add_idea ('$login', '$title', '$content', @id)");
        if ($conn->errno) {
            $conn->rollback();
            die;
        }
        $idea_id = $conn->query("SELECT @id")->fetch_row()[0];
        if ($conn->errno) {
            $conn->rollback();
            die;
        }

        $tag_ids = array();
        foreach (explode(',', $tags) as $tag) {
            if ($conn->query("INSERT INTO tags(name) VALUES ('$tag')")) {
                array_push($tag_ids, $conn->insert_id);
            } else {
                array_push($tag_ids, $conn->query("SELECT tag_id FROM tags WHERE name = '$tag'")->fetch_row()[0]);
            }
        }
        foreach ($tag_ids as $tag_id) {
            if (!$conn->query("INSERT INTO tag_link(idea_id, tag_id) VALUES ($idea_id, $tag_id)") && $conn->errno) {
                $conn->rollback();
                die;
            }
        }
        $conn->commit();
        header('Location: ' . $GLOBALS['mainFolder'] . '/idea/' . $idea_id);
    }

    private function getComments($id)
    {
        $result = MySQL::getConn()->query("SELECT * FROM comments WHERE source_id = '$id'")->fetch_all(MYSQLI_ASSOC);
        foreach ($result as &$comment) {
            $comment['subComments'] = $this->getComments($comment['comment_id']);
        }
        return $result;
    }
}