<?php
class Music_Controller
{
    public static function ListAction($arg)
    {
        $model = new Music_Model();
        $view = new Music_View();

        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);
        if($user == null)
            header("Location:/");

        $musicList = $model->GetMusicList($user[0]);

        return array(
            "PageTitle" => "Музыка",
            'Content' => $view->MusicList($musicList, $CurrentUser['id'], $user[0]['id'])
        );
    }

    public function AddAction()
    {
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Music_Model();

        $data = "__Bad_Argument__";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {
        print_r($_POST);

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/music/", $_FILES['song_file']);

            if ($name != -1) {
                $arr = array(
                    'title' => $_POST['title'],
                    'url' => "media/music/" . pathinfo("media/music/" . $name, PATHINFO_FILENAME)
                );
                $musicId = $model->AddMusic($arr);
                $model->AddOwner($user['id'], $musicId);
                $data = "__Add__";
            }
        }
        echo(json_encode($data));
    }

    public function DeleteAction(){
        $user = $_SESSION['user'];
        $model = new Music_Model();

        $data = "__error__";

        if ($user != null || $_SERVER['REQUEST_METHOD'] == "POST") {
            $DeleteId = $_POST['num'];
            $model->DeleteOwner($user['id'], $DeleteId);
            $data = "__deleted__";
        }

        echo(json_encode($data));
    }
}