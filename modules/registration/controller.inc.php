<?php
class Registration_Controller
{
    public function AddAction() {
        $model = new Registration_Model();
        $view = new Registration_View();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($model->AddUser($user))
            {
                return Menu_Controller::CreateAction();
            }
        }
        return array(
            "Content" => $view->Add()
        );
    }
    public function LoginAction() {
        $m = new Registration_Model();
        $v = new Registration_View();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST;
            if ($m->Login($user))
            {
                return Menu_Controller::CreateAction();
            }
        }
        return array(
            "Content" => $v->Login()
        );
    }
    public function LogoutAction() {
        $_SESSION['user'] = null;
        header("Location: /");
    }
}