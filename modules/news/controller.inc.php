<?php
class News_Controller
{
    public function SaveAction() {
        $model = new News_Model();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $news = array();
            $news = $_POST;
            if ($_FILES && $_FILES['news_images']['error'][0] == UPLOAD_ERR_OK)
            {
                $news['images'] = $_FILES['news_images'];
            }
            if ($_FILES && $_FILES['news_audios']['error'][0] == UPLOAD_ERR_OK)
            {
                $news['audios'] = $_FILES['news_audios'];
            }
            if ($_FILES && $_FILES['news_videos']['error'][0] == UPLOAD_ERR_OK)
            {
                $news['videos'] = $_FILES['news_videos'];
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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $from = $_POST['from'];
            $pageType = $_POST['pageType'];
            $owner = $_POST['owner'];
            $model = new News_Model();
            $newsList = $model->NewsList($from, $owner, $pageType);
            $res = json_encode($newsList);
            echo $res;
            exit(); 
        }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }

    public function DeleteAction() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postId = $_POST['postId'];
            $newsModel = new News_Model();
            $newsModel->DeleteNews($postId);
            exit();
        }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }

    public function LikeAction() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postId = $_POST['postId'];
            $action = $_POST['action'];
            $model = new News_Model();
            $model->ToggleLike($postId, $action);
            $likeCount = 0;
            $likeCount = $model->LikeCount($postId);
            echo($likeCount[0]['count']);
            exit();
        }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }

    public function AddcommentAction() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postId = $_POST['postId'];
            $text = $_POST['text'];
            $replyId = null;
            if(isset($_POST['reply_id'])) {
                $replyId = $_POST['reply_id'];
            }
            $model = new News_Model();
            $arrayForSave = $model->AddComment($postId, $text, $replyId);
            $user = Core::$Db->SelectJoin("user_data", 'image, name, surname', array("user_id" => $_SESSION['user']['id']));
            $arrayForSave['image'] = $user[0]['image'];
            $arrayForSave['name'] = $user[0]['name'];
            $arrayForSave['surname'] = $user[0]['surname'];
            echo json_encode($arrayForSave);   
            exit();
            }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }

    public function GetcommentAction() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postId = $_POST['postId'];
            $model = new News_Model();
            $comments = $model->CommentList($postId);
            echo json_encode($comments);
            exit();
        }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }

    public function DeletecommentAction() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $commentId = $_POST['commentId'];
            Core::$Db->DeleteById('comment', 'id', $commentId);
            exit();
        }
        else {
            return array(
            "Content"  => "Page not found!";
            );
        }
    }
 }