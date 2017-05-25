<?php
class Registration_View
{
    public function Add()
    {
        $tpl = new Template('template/registration/add.tpl');
        return $tpl->GetHTML();
    }
}