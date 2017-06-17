<?php
class Chat_Model
{
    public function Save($item) {
        Core::$Db->Insert("mesages", $item);
    }

    public function GetNewMessagesCount($userId, $senderId = null) {
        $count = Core::$Db->SelectJoin('mesages', 'COUNT(id) as count', array('reciever_id' => $userId, 'is_readed' => 0));
        if(!is_null($senderId)) {
            $count = Core::$Db->SelectJoin('mesages', 'COUNT(id) as count', array('reciever_id' => $userId, 'is_readed' => 0, 'sender_id' => $senderId));
        }
        return $count;
    }

    public function UsersList() {
        $usersSend = Core::$Db->SelectJoin('mesages', array('DISTINCT user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('mesages.sender_id' => $_SESSION['user']['id']), null, null,  null, array('user_data' => array('mesages.reciever_id' => 'user_data.user_id')), null);
        $usersRecieve = Core::$Db->SelectJoin('mesages', array('DISTINCT user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('mesages.reciever_id' => $_SESSION['user']['id']), null, null,  null, array('user_data' => array('mesages.sender_id' => 'user_data.user_id')), null);
        $result['messagesArray'] = array_unique(array_merge($usersRecieve, $usersSend), SORT_REGULAR);
        for($i = 0; $i < count($result['messagesArray']); $i++) {
            $result['messagesArray'][$i]['newMessagesCount'] = $this->GetNewMessagesCount($_SESSION['user']['id'], $result['messagesArray'][$i]['user_id'])[0]['count'];
        }
        return $result;
    }

    public function MessagesList($userId) {
        $messages = Core::$Db->SelectMessages($userId, $_SESSION['user']['id']);
        return $messages;
    }

    public function SetReaded($userId) {
        Core::$Db->UpdateMessages($_SESSION['user']['id'], $userId);
    }
}