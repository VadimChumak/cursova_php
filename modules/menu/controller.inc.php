<?php
class Menu_Controller
{
    public static function CreateAction()
    {
        $MenuTPL = new Template("template/menu/main.tpl");
        $MenuTPL->SetParam("UserInfo", $_SESSION['user']);
        $view = new Menu_View();
        return array(
            "Content"  => $MenuTPL->GetHTML()    
        );
    }
}