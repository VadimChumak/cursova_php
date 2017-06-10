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

        if ($user == null || $_SERVER['REQUEST_METHOD'] != "POST")
            header("Location:/");


        if (!isset($_POST['title']) || !isset($_FILES['song_file']))
            header("Location:/");

        $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"]."/media/music/", $_FILES['song_file']);

        if ($name != -1) {
            $arr = array(
                'title' => $_POST['title'],
                'url' => "media/music/" .pathinfo("media/music/" . $name, PATHINFO_FILENAME)
            );
            $musicId = $model->AddMusic($arr);
            $model->AddOwner($user['id'], $musicId);
        }
        header("Location:".$_SERVER["DOCUMENT_ROOT"] . "/music/list/" . $user['id']);
    }

    public function DeleteAction($attr){
        $DeleteId = $attr[0];

        $user = $_SESSION['user'];
        $model = new Music_Model();

        if ($user == null || $_SERVER['REQUEST_METHOD'] != "POST")
            header("Location:/");


        $model->DeleteOwner($user['id'], $DeleteId);

        header("Location:".$_SERVER["DOCUMENT_ROOT"] . "/music/list/" . $user['id']);
    }
}