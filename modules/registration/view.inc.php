<?php
class Registration_View
{
    public function Add()
    {
        $tpl = new Template('template/registration/add.tpl');
        return $tpl->GetHTML();
    }
    public function Login()
    {
        $tpl1 = new Template('template/registration/login.tpl');
        return $tpl1->GetHTML();
    }
}