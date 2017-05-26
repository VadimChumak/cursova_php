<?php
class Menu_View
{
    public function Generate()
    {
        $tpl = new Template('template/menu/main.tpl');
        return $tpl->GetHTML();
    }
}