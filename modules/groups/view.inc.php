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

    public function Edit($group)
    {
        $tpl = new Template('template/groups/edit.tpl');
        $tpl->SetParam('Group',$group);
        return $tpl->GetHTML();
    }

    public function Group($group, $member, $admin)
    {
        $tpl = new Template('template/groups/group.tpl');
        $tpl->SetParam('List',$group);
        $tpl->SetParam('member',$member);
        $tpl->SetParam('admin',$admin);
        return $tpl->GetHTML();
    }
}