<?php
class File_Controller
{
    public static function ListAction($arg)
    {
        $model = new File_Model();
        $view = new File_View();
        $userPage = new User_View();
        $CurrentUser = $_SESSION['user'];

        $modelUser = new User_Model();

        $user = $modelUser->GetUserAuth($arg[0]);
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        if($user == null)
            header("Location:/");

        $musicList = $model->GetFileList($user[0]);

        $params = array(
            "PageTitle" => "File",
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->FileList($musicList, $CurrentUser['id'], $user[0]['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function AddAction()
    {   date_default_timezone_set("Europe/Riga");
        $user = $_SESSION['user'];
        $core = new Core();
        $model = new File_Model();

        $data = "BadArgument";
        if ($user != null && $_SERVER['REQUEST_METHOD'] == "POST") {

            $name = $core->saveToDir($_SERVER["DOCUMENT_ROOT"] . "/media/file/", $_FILES['file_file']);

            if ($name != -1) {
                $arr = array(
                    'title' => $_POST['title'],
                    'url' => "media/file/" .  $name,
                    'date' => date("Y-m-d H:i:s", time())
                );

                $fileId = $model->AddFile($arr);
                $model->AddOwner($user['id'], $fileId);
                $data = "Add";
            }
        }
        echo(json_encode($data));
        exit();
    }
}