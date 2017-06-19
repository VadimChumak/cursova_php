<?php
class Photo_View
{

    public function PhotoList($photoList, $currentUserId, $pageUserId)
    {
        $tpl = new Template('template/photo/list.tpl');
        $tpl->SetParam('List',$photoList);
        $tpl->SetParam('CurrentId',$currentUserId);
        $tpl->SetParam('PageId',$pageUserId);
        return $tpl->GetHTML();
    }

}