<?php
class News_Controller
{
    public function SaveAction() {
        $model = new News_Model();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $news = array();
            $news = $_POST;
            if ($_FILES && $_FILES['newsImage']['error'] == UPLOAD_ERR_OK)
            {
                $news['imageName'] = $_FILES['newsImage']['name'];
                $news['imageTmp'] = $_FILES['newsImage']['tmp_name'];
            }
            $res = json_encode($model->Save($news));
            echo $res;
            exit();
        }
        else {
            echo json_encode(array('status' => 'error'));
            exit();
        }
    }
    public function GetAction() {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $owner = $_POST['owner'];
        $newsList=Core::$Db->SelectPosts($owner, 'user', $from);
        for($i = 0; $i <count($newsList); $i++) {
            if(empty(Core::$Db->SelectJoin('bookmarks', '*', array('item_id' => $newsList[$i]['id'], 'user_id' => $_SESSION['user']['id']), null,  null, null, null, null))) {
                $newsList[$i]['isLiked'] = false;
            }
            else {
                $newsList[$i]['isLiked'] = true;
            }
        }
        $res = json_encode($newsList);
        echo $res;
        exit(); 
    }

    public function DeleteAction() {
        $postId = $_POST['postId'];
        Core::$Db->DeleteById("post", "id", $postId);
    }

    public function LikeAction() {
        $postId = $_POST['postId'];
        $action = $_POST['action'];
        $likeCount = 0;
        if($action == "set") {
            Core::$Db->Insert('bookmarks', array('user_id' => $_SESSION['user']['id'], 'item_id' => $postId));
            $likeCount = Core::$Db->SelectJoin('bookmarks', array('COUNT(item_id) as count'), array('item_id' => $postId), null,  null, null, null, null);
        }
        else {
            Core::$Db->DeleteByTwoCays("bookmarks", 'item_id', $postId, 'user_id', $_SESSION['user']['id']);
            $likeCount = Core::$Db->SelectJoin('bookmarks', array('COUNT(item_id) as count'), array('item_id' => $postId), null,  null, null, null, null);
        }
        echo($likeCount[0]['count']);
        exit();
    }
}