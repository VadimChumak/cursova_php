<?php
class Photo_Controller
{
    public static function ListAction($arg)
    {
        $model = new Photo_Model();
        $view = new Photo_View();

        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);

        if($user == null)
            header("Location:/");

        $photoList = $model->GetPhotoList($user[0]);
        $userPage = new User_View();
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        $params = array(
            "PageTitle" => "Музыка",
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->PhotoList($photoList, $CurrentUser['id'], $user[0]['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function AddAlbumAction(){
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Photo_Model();

        $data = "Bad_Argument";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {
            $arr = array(
                'title' => $_POST['title'],
                'user_id' => $user[0]['id']
            );

            $albumId = $model->AddAlbum($arr);

            $data = "add";
        }
        echo(json_encode($data));
        exit();
    }

    public function AddAction()
    {
        date_default_timezone_set("Europe/Riga");
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new Photo_Model();

        $data = "Bad_Argument";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/photo/", $_FILES['photo_file']);

            if ($name != -1) {
                $arr = array(
                    'url' => "media/photo/" . $name,
                    'date' => date("Y-m-d H:i:s", time())
                );

                $photoId = $model->AddPhoto($arr);
                $model->AddOwner($user['id'], $photoId);
                $data = "Add";
            }
        }
        echo(json_encode($data));
        exit();
    }

    public function DeleteAction(){
        $user = $_SESSION['user'];
        $model = new Photo_Model();

        $data = "error";

        if ($user != null || $_SERVER['REQUEST_METHOD'] == "POST"
        && isset($_POST['num'])) {
            $DeleteId = $_POST['num'];
            $model->DeleteOwner($user['id'], $DeleteId);
            $data = "deleted";
        }

        echo(json_encode($data));
        exit();
    }

}