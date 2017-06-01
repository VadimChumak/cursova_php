<?php
class Music_View
{

    public function MusicList($musicList)
    {
        $tpl = new Template('template/music/list.tpl');
        $tpl->SetParam('List',$musicList);
        return $tpl->GetHTML();
    }

}