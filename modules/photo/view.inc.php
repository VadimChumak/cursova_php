<?php
class Photo_View
{

    public function VideoList($videoList, $currentUserId, $pageUserId)
    {
        $tpl = new Template('template/video/list.tpl');
        $tpl->SetParam('List',$videoList);
        $tpl->SetParam('CurrentId',$currentUserId);
        $tpl->SetParam('PageId',$pageUserId);
        return $tpl->GetHTML();
    }

}