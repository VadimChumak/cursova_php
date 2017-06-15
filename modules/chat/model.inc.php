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
}