<?php
class Groups_Model
{
    public function GetGroupList($user) {
        //now get all group of all user
        //add (inner ... join to select)
        $List = Core::$Db->Select('groups','id,title,owner_id,photo_url');
        return $List;
    }

    public function GetGroupIdList($user) {
        $List = Core::$Db->Select( 'group_user','group_id,user_id', array('user_id' => $user['id']) );
        return $List;
    }

    public function GetGroup($id) {
        $List = Core::$Db->Select( 'groups','id,title,photo_url', array('id' => $id) );
        return $List;
    }

    public  function AddGroup($userCreator, $group){
        Core::$Db->Insert("groups", array('title' => $group['title'], 'owner_id' => $userCreator['id'],
            'photo_url' =>  $group['photo_url'] ));
    }

    //table now just in my db
    public  function AddUserToGroup($user, $group){
        Core::$Db->Insert("group_user", array('group_id' => $group['id'], 'user_id' => $user['id']));
    }

    //table now just in my db
    public  function DeleteUserFromGroup($user){
        Core::$Db->DeleteById("group_user", 'user_id',  $user['id'] );
    }

}