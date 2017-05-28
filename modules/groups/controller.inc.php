<?php
class Groups_Controller
{
    public static function ListAction()
    {
        $userModel = new Registration_Model();

        $model = new Groups_Model();
        $view = new Groups_View();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($userModel->AddUser($user))
            {
                return Menu_Controller::CreateAction();
            }

        }


        $groupList = $model->GetGroupList($user);

        return array(
            "PageTitle" => "Групи",
            'Content' => $view->GroupList($groupList)
        );

    }


    public static function GroupAction($arg)
    {
        $userModel = new Registration_Model();

        $model = new Groups_Model();
        $view = new Groups_View();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = $_POST;
            if ($userModel->AddUser($user)) {
                return Menu_Controller::CreateAction();
            }
        }

        $groupId = ($arg[0]);
        $group = $model->GetGroup($groupId);

        return array(
            "PageTitle" => "Групи",
            'Content' => $view->Group($group)
        );
    }

    public function EditAction($params)
    {
        return array(
            "PageTitle" => "Сторінка редагування новини",
            "PageHeaderTitle" => "Сторінка редагування новини",
            "Content" => "Контент"
        );
    }
}