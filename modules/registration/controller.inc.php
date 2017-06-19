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
                $UserController = new User_Controller();
                return $UserController->IdAction(array($_SESSION['user']['id']));
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
                $UserController = new User_Controller();
                return $UserController->IdAction(array($_SESSION['user']['id']));
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