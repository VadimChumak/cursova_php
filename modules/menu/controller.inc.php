<?php
class Menu_Controller
{
    public static function CreateAction()
    {
        $view = new Menu_View();
        return array(
            "Content"  => array(
                'Content' => $view->Generate()
            ),
            "Session" => $_SESSION['user']       
        );
    }
}