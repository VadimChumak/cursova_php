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

        $musicList = $model->GetVideoList($user[0]);

        return array(
            "PageTitle" => "Video",
            'Content' => $view->VideoList($musicList, $CurrentUser['id'], $user[0]['id'])
        );
    }

    public function CopyAction(){
        $model = new Video_Model();

        $user = $_SESSION['user'];
        $data = "__Bad_Argument__";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
            $videoId = $_POST['id'];

            $CurrentVideo = $model->GetVideoById($videoId);

            $arr = array(
                'title' => $CurrentVideo['title'],
                'url' => $CurrentVideo['url'],
                'date' => date("Y-m-d H:i:s")
            );

            $videoId = $model->AddVideo($arr);

            $model->AddOwner($user['id'], $videoId);
            $data =  $data = "__Add__";
        }
        echo(json_encode($data));
    }

    public function AddAction()
    {   date_default_timezone_set("Europe/Riga");
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Music_Model();

        $data = "__Bad_Argument__";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/video/", $_FILES['video_file']);

            if ($name != -1) {
                $arr = array(
                    'title' => $_POST['title'],
                    'url' => "media/music/" . pathinfo("media/video/" . $name, PATHINFO_FILENAME),
                    'date' => date("Y-m-d H:i:s", time())
                );

                $videoId = $model->AddVideo($arr);
                $model->AddOwner($user['id'], $videoId);
                $data = "__Add__";
            }
        }
        echo(json_encode($data));
        exit();
    }

    public function DeleteAction(){
        $user = $_SESSION['user'];
        $model = new Video_Model();

        $data = "__error__";

        if ($user != null || $_SERVER['REQUEST_METHOD'] == "POST") {
            $DeleteId = $_POST['num'];
            $model->DeleteOwner($user['id'], $DeleteId);
            $data = "__deleted__";
        }

        echo(json_encode($data));
        exit();
    }
}