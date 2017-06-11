<?php
class Video_Controller
{
    public static function ListAction($arg)
    {
        $model = new Video_Model();
        $view = new Video_View();

        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);

        if($user == null)
            header("Location:/");

        $videoList = $model->GetVideoList($user[0]);

        return array(
            "PageTitle" => "Video",
            'Content' => $view->VideoList($videoList, $CurrentUser['id'], $user[0]['id'])
        );
    }

    public function AddAction()
    {
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Video_Model();

        if ($user == null || $_SERVER['REQUEST_METHOD'] != "POST")
            header("Location:/");


        if (!isset($_POST['title']) || !isset($_FILES['video_file']))
            header("Location:/");

        $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"]."/media/video/", $_FILES['video_file']);

        if ($name != -1) {
            $arr = array(
                'title' => $_POST['title'],
                'url' => "media/video/" .pathinfo("media/video/" . $name, PATHINFO_FILENAME)
            );
            $videoId = $model->AddVideo($arr);
            $model->AddOwner($user['id'], $videoId);
        }
        header("Location:".$_SERVER["DOCUMENT_ROOT"] . "/video/list/" . $user['id']);
    }

    public function DeleteAction($attr){
        $DeleteId = $attr[0];

        $user = $_SESSION['user'];
        $model = new Video_Model();

        if ($user == null || $_SERVER['REQUEST_METHOD'] != "POST")
            header("Location:/");


        $model->DeleteOwner($user['id'], $DeleteId);

        header("Location:".$_SERVER["DOCUMENT_ROOT"] . "/video/list/" . $user['id']);
    }
}