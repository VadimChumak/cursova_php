<?php
class User_View
{
    public function GetUserPage($params) {
        $userTMP = new Template("template/user/main.tpl");
        $userTMP->SetParams($params);
        return $userTMP->GetHTML();
    }

    public function GetUserInfo($params) {
        $userTMP = new Template("template/user/about.tpl");
        $userTMP->SetParams($params);
        return $userTMP->GetHTML();
    }
}