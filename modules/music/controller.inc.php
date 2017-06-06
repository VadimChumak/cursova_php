<?php
class Music_Controller
{
    public static function ListAction()
    {
        $userModel = new Registration_Model();

        $model = new Music_Model();
        $view = new Music_View();

        $user = $_SESSION['user'];

        $musicList = $model->GetMusicList($user);

        return array(
            "PageTitle" => "Музыка",
            'Content' => $view->MusicList($musicList)
        );

    }
}