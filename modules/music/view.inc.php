<?php
class Music_View
{

    public function MusicList($musicList, $currentUserId, $pageUserId)
    {
        $tpl = new Template('template/music/list.tpl');
        $tpl->SetParam('List',$musicList);
        $tpl->SetParam('CurrentId',$currentUserId);
        $tpl->SetParam('PageId',$pageUserId);
        return $tpl->GetHTML();
    }

}