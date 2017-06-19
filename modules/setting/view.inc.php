<?php
class Setting_View
{
    public function Edit()
    {
        $tpl = new Template('template/setting/main.tpl');
        return $tpl->GetHTML();
    }
}