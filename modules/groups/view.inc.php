<?php
class Groups_View
{
    public function Add()
    {
        $tpl = new Template('template/groups/main.tpl');
        return $tpl->GetHTML();
    }

    public function GroupList($groupList)
    {
        $tpl = new Template('template/groups/list.tpl');
        $tpl->SetParam('List',$groupList);
        return $tpl->GetHTML();
    }

    public function Group($group)
    {
        $tpl = new Template('template/groups/group.tpl');
        $tpl->SetParam('List',$group);
        return $tpl->GetHTML();
    }
}