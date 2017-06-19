<?php
class Music_Controller
{
    public static function ListAction($arg)
    {
        $model = new Music_Model();
        $view = new Music_View();
        $userPage = new User_View();
        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);
        if($user == null)
            header("Location:/");

        $musicList = $model->GetMusicList($user[0]);
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));
        $params = array(
            "PageTitle" => "Музыка",
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->MusicList($musicList, $CurrentUser['id'], $user[0]['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function CopyAction(){
        $model = new Music_Model();

        $user = $_SESSION['user'];
        $data = "__Bad_Argument__";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id'])) {
            $musicId = $_POST['id'];

            $CurrentSong = $model->GetSongById($musicId);

            $arr = array(
                'title' => $CurrentSong['title'],
                'url' => $CurrentSong['url'],
                'date' => date("Y-m-d H:i:s")
            );

            $musicId = $model->AddMusic($arr);

            $model->AddOwner($user['id'], $musicId);
            $data =  $data = "__Add__";
        }
        echo(json_encode($data));
        exit();
    }

    public function AddAction()
    {   date_default_timezone_set("Europe/Riga");
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Music_Model();

        $data = "__Bad_Argument__";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/music/", $_FILES['song_file']);

            if ($name != -1) {
                $arr = array(
                    'title' => $_POST['title'],
                    'url' => "media/music/" . pathinfo("media/music/" . $name, PATHINFO_FILENAME),
                    'date' => date("Y-m-d H:i:s", time())
                );

                $musicId = $model->AddMusic($arr);
                $model->AddOwner($user['id'], $musicId);
                $data = "__Add__";
            }
        }
        echo(json_encode($data));
        exit();
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
        exit();
    }
}