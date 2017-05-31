<?php
class Menu_Controller
{
    public static function CreateAction()
    {
        $MenuTPL = new Template("template/menu/main.tpl");
        $NewsView = new News_View();
        $MenuTPL->SetParam("UserInfo", $_SESSION['user']);
        $newsList['newsArray'] = Core::$Db->SelectNumberOfRecords("post", "*", "0", "10", array('page_owner_id' => "3"), array("publishing_date"));
        $MenuTPL->SetParam("newsSection", $NewsView->GetNewsList($newsList));
        $view = new Menu_View();
        return array(
            "Content"  => $MenuTPL->GetHTML()
        );
    }
}