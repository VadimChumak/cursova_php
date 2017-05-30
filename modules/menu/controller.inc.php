<?php
class Menu_Controller
{
    public static function CreateAction()
    {
        $MenuTPL = new Template("template/menu/main.tpl");
        $MenuTPL->SetParam("UserInfo", $_SESSION['user']);
        $NewsTPL = new Template("template/news/newsList.tpl");
        $newsList = Core::$Db->SelectNumberOfRecords("post", "*", "0", "10", array('page_owner_id' => "3"), "publishing_date");
        $NewsTPL->SetParam("newsArray", $newsList);
        $MenuTPL->SetParam("newsSection", $NewsTPL->GetHTML());
        $view = new Menu_View();
        return array(
            "Content"  => $MenuTPL->GetHTML()
        );
    }
}