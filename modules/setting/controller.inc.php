<?php
class Setting_Controller
{
    public function EditAction()
    {
        $userModel = new User_Model();
        $user = $userModel->GetUser(array($_SESSION['user']['id']));
        if(empty($user)) {
            return array(
            "Content"  => "404"
        );}
        $userPage = new User_View();
        $view = new Setting_View();
        $model = new Setting_Model();
        $settingTPL = new Template("template/setting/main.tpl");
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($model->Edit($user))
            {
                $UserController = new User_Controller();
                return $UserController->IdAction(array($_SESSION['user']['id']));
            }
        }
        else {
            $settingTPL->SetParam('UserInfo', $model->GetInfo($_SESSION['user']['id'])[0]);
            $params = array(
                'CurrentUser' => $_SESSION['user'],
                'UserInfo' => $user[0],
                'AboutSection' => $settingTPL->GetHTML()
            );
            return array(
                 "Content"  => $userPage->GetUserPage($params)
            );
        }
        return array(
          'Content' => $view->Edit()
        );

    }
}