<?php
class Groups_Controller
{
    public static function ReadAction()
    {
        $model = new Groups_Model();
        $view = new Groups_View();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($model->AddUser($user))
            {
                return Menu_Controller::CreateAction();
            }

        }
        return array(
            "PageTitle" => "Сторінка додавання новини",
            /* "PageHeaderTitle" => "Сторінка додавання новини",*/
            "Content"  => array(
                "Session" => $_SESSION['user'],
                'Content' => $view->Add()
            )
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