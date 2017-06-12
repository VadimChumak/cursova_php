<?php
class Friends_Model
{
    public function AddToFriends($user1, $user2)
    {
        Core::$Db->Insert('friend', array('user_id' => $user1['id'], 'friend_id' => $user2, 'is_accepted1' => 1, 'is_accepted2' => 0));
    }
    public function Accept()
    {
        $list = Core::$Db->SelectJoin('friend', 'user_data.user_id, user_data.name, user_data.surname, user_data.image', array('friend.friend_id' => $_SESSION['user']['id'], 'friend.is_accepted2' => 0), null, null, null, array('user_data' => array('user_data.user_id' => 'friend.user_id')));
        return $list;
    }
}