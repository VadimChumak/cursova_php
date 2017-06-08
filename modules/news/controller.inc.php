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
        $newsList=Core::$Db->SelectJoin("post", array('post.id', 'post.owner_id', 'post.post_text', 'post.publishing_date', 'post.photo_url', 'post.page_owner_id', 'user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('page_owner_id' => $owner, 'page_type' => 'user'), array("publishing_date"), 'DESC', null, array('user_data' => array('user_data.user_id' => 'post.owner_id')), array('from' => $from, 'count' => 10));
        $res = json_encode($newsList);
        echo $res;
        exit(); 
    }

    public function DeleteAction() {
        $postId = $_POST['postId'];
        Core::$Db->DeleteById("post", "id", $postId);
    }
}