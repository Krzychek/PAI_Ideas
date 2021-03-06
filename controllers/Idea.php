<?php class Idea extends Controller
{
    function call($params)
    {
        if ($params[0] === "new") {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    (new vAddIdea())->render();
                    break;
                case 'POST':
                    $this->addNew();
                    break;
            }
        } else {
            Auth::check_auth();
            $conn = MySQL::getConn();
            $id = $conn->real_escape_string($params[0]);
            $idea_data = $conn->query("SELECT * FROM ideas_details WHERE idea_id = '$id'")->fetch_assoc();
            $login = $GLOBALS['login'];
            $vote = $conn->query("SELECT up FROM votes WHERE idea_id = '$id' AND voter_login = '$login'");
            if ($vote and $vote->num_rows > 0) {
                $vote = $vote->fetch_row()[0];
                if ($vote === '1') $vote = 1;
                else $vote = -1;
            } else {
                $vote = 0;
            }
            $view = new vIdea($idea_data, $this->getComments($id), $vote);
            $view->render();
        }
    }

    private function addNew()
    {
        Auth::check_auth('add_idea');
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