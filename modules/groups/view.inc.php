<?php
class Groups_View
{
    public function Add()
    {
        $tpl = new Template('template/groups/main.tpl');
        return $tpl->GetHTML();
    }
}