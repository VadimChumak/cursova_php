<?php
class Friends_View
{
    public function Accept($friendList)
    {
        $friendTPL = new Template("template/friends/main.tpl");
        $friendTPL->SetParams($friendList);
        return $friendTPL->GetHTML();
    }
}