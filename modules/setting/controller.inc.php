<?php
class Setting_Controller
{
    public function EditAction()
    {
        $view = new Setting_View();
        $model = new Setting_Model();
        $settingTPL = new Template("template/setting/main.tpl");
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($model->Edit($user))
            {
                return Menu_Controller::CreateAction();
            }
        }
        else {
            $settingTPL->SetParam('UserInfo', $model->GetInfo($_SESSION['user']['id'])[0]);
            return array(
                'Content' => $settingTPL->GetHTML()
            );
        }
        return array(
          'Content' => $view->Edit()
        );

    }
}