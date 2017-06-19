<?php
class News_View
{
    public function GetNewsList($paramsArray) {
        $tpl = new Template("template/news/newsList.tpl");
        $tpl->SetParams($paramsArray);
        return $tpl->GetHTML();
    } 

    public function Scripts() {
        $scriptTPL = new Template('template/news/script.tpl');
        return $scriptTPL->GetHTML();
    } 
}