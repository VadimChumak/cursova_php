<?php
class File_View
{

    public function FileList($fileList, $currentUserId, $pageUserId)
    {
        $tpl = new Template('template/file/list.tpl');
        $tpl->SetParam('List',$fileList);
        $tpl->SetParam('CurrentId',$currentUserId);
        $tpl->SetParam('PageId',$pageUserId);
        return $tpl->GetHTML();
    }
}