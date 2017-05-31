<?php
class User_View
{
    public function GetUserPage($params) {
        $userTMP = new Template("template/user/main.tpl");
        $userTMP->SetParams($params);
        return $userTMP->GetHTML();
    }
}