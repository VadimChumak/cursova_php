<?php
class News_Controller
{
    public function SaveAction() {
        $model = new News_Model();
        $view = new News_View();
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
}