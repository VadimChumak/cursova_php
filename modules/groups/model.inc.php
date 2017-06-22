<?php
class Groups_Model
{
    public function GetGroupList($user) {
        $List = Core::$Db->Select('groups','id,title,owner_id,photo_url', array('group_user.user_id' => $user['id'] ) ,
            'group_user',array('group_user.group_id' => 'id'), array('groups.id'));
        return $List;
    }

    public function GetGroupIdList($user) {
        $List = Core::$Db->Select( 'group_user','group_id,user_id', array('user_id' => $user['id']) );
        return $List;
    }
    //Edit group info
    public function Edit($array, $group) {
        Core::$Db->UpdateById( 'groups',$array,'id', $group[0]['id'] );
    }

    public function GetGroup($id) {
        $List = Core::$Db->Select( 'groups','id,title,owner_id,photo_url', array('id' => $id) );
        return $List;
    }

    public  function AddGroup($userCreator, $group){
        $id = Core::$Db->Insert("groups", array('title' => $group['title'], 'owner_id' => $userCreator['id'],
            'photo_url' =>  $group['photo_url'] ));
        return $id;
    }

    public function isGroupExistById($id)
    {
        $List = Core::$Db->Select( 'groups','id,title,owner_id,photo_url', array('id' => $id) );
        return (isset($List[0]));
    }

    //table now just in my db
    public  function AddUserToGroup($user, $group){
        Core::$Db->Insert("group_user", array('group_id' => $group[0]['id'], 'user_id' => $user['id']));
    }

    //table now just in my db
    public  function DeleteByTwoCays($user, $group){
        Core::$Db->DeleteByTwoCays("group_user", 'user_id',  $user['id'] , 'group_id', $group[0]['id']);
    }

    public function isMember($group, $user)
    {
        $List = Core::$Db->Select( 'group_user','group_id',
            array('group_id' => $group[0]['id'], 'user_id' => $user['id']  ) );

        return (isset($List[0]));
    }

    public  function isGroupAdmin($group, $user){
        if($group[0]['owner_id'] == $user['id'])
            return true;

        $List = Core::$Db->Select( 'group_admin','group_id',
            array('group_id' => $group[0]['id'], 'user_id' => $user['id']  ) );
        return (isset($List[0]));
    }

    public function IdLastCreatedGroupByUser($user){
        $List = Core::$Db->Select( 'groups','id',
            array('owner_id' => $user['id']));

        $max = $List[0]['id'];
        foreach ($List as $value){
            if($max<$value['id'])
                $max = $value['id'];
        }

        return $max;
    }

}