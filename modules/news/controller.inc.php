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
            die();
        }
        else {
            echo json_encode(array('status' => 'error'));
            die();
        }
    }
    public function GetAction() {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $newsList= Core::$Db->SelectNumberOfRecords("post", "*", $from, $to, array('page_owner_id' => '3', 'page_type' => 'user'), array("publishing_date"));
        $res = json_encode($newsList);
        echo $res;
        die(); 
    }
}