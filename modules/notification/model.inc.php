<?php
class Notification_Model{
    public function Save($userId, $type, $itemId) {
        date_default_timezone_set("Europe/Riga");
        $notificationId = Core::$Db->Insert('notification', array('user_id' => $userId,'type' => $type, 'item_id' => $itemId, 'is_checked' => 0, 'date' => date('Y-m-d H:i:s', time()), 'user_action' => $_SESSION['user']['id']));
        return $notificationId;
    }

    public function GetNew($userId, $startDate) {
        return Core::$Db->NewNotification($userId, $startDate);
    }
}