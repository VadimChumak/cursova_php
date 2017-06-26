<?php
class Video_Controller
{
    public static function ListAction($arg)
    {
        $model = new Video_Model();
        $view = new Video_View();
        $userPage = new User_View();
        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);
        if($user == null)
            header("Location:/");

        $videoList = $model->GetVideoList($user[0]);
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));
        $params = array(
            "PageTitle" => "Video",
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->VideoList($videoList, $CurrentUser['id'], $user[0]['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function AddAction()
    {
        date_default_timezone_set("Europe/Riga");
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Video_Model();

        $data = "Bad_Argument";
        $title = $_POST['title'];
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST" && $title!='' && isset($_FILES['video_file'])) {

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/video/", $_FILES['video_file']);

            if ($name != -1) {
                $arr = array(
                    'title' => $title,
                    'url' => "media/video/" . pathinfo("media/video/" . $name, PATHINFO_FILENAME),
                    'date' => date("Y-m-d H:i:s", time())
                );

                $videoId = $model->AddVideo($arr);
                $model->AddOwner($user['id'], $videoId);
                $data = "Add";
            }
        }
        echo(json_encode($data));
        exit();
    }

    public function DeleteAction(){
        $user = $_SESSION['user'];
        $model = new Video_Model();

        $data = "error";

        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {
            $DeleteId = $_POST['num'];
            $model->DeleteOwner($user['id'], $DeleteId);
            $data = "deleted";
        }

        echo(json_encode($data));
        exit();
    }
}