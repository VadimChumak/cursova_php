<?php
class Friends_Model
{
    
    public function AddToFriends($user1, $user2)
    {
        Core::$Db->Insert('friend', array('user_id' => $user1['id'], 'friend_id' => $user2, 'is_accepted1' => 1, 'is_accepted2' => 0));
    }
    public function Accept($user1, $user2)
    {
        Core::$Db->UpdateFriends('friend', array('is_accepted2' => 1), 'friend_id' , $user1['id'], 'user_id' , $user2);
    }
    public static function AlreadySended($user1, $user2) {
        $res1 = Core::$Db->Select('friend', '*', array('user_id' => $user1, 'friend_id' => $user2));
        $res2 = Core::$Db->Select('friend', '*', array('user_id' => $user2, 'friend_id' => $user1));
        if (!empty($res1) || !empty($res2)) {
            return true;
        }
        return false;
    }
    public function Remove($user1, $user2) {
        Core::$Db->DeleteFriends('friend', 'friend_id' , $user1['id'], 'user_id' , $user2);
    }
    public function SendersList()
    {
        $list = Core::$Db->SelectJoin('friend', 'user_data.user_id, user_data.name, user_data.surname, user_data.image', array('friend.friend_id' => $_SESSION['user']['id'], 'friend.is_accepted2' => 0), null, null, null, array('user_data' => array('user_data.user_id' => 'friend.user_id')));
        return $list;
    }
    public function FriendList($user_id)
    {
        $list1 = Core::$Db->SelectJoin('friend', 'user_data.user_id, user_data.name, user_data.surname, user_data.image', array('friend.friend_id' => $user_id, 'friend.is_accepted2' => 1, 'friend.is_accepted1' => 1), null, null, null, array('user_data' => array('user_data.user_id' => 'friend.user_id')));
        $list2 = Core::$Db->SelectJoin('friend', 'user_data.user_id, user_data.name, user_data.surname, user_data.image', array('friend.user_id' => $user_id, 'friend.is_accepted2' => 1, 'friend.is_accepted1' => 1), null, null, null, array('user_data' => array('user_data.user_id' => 'friend.friend_id')));
        $list = array_merge($list1, $list2);
        return $list;
    }
}