<?php
class Notification_Model{
    public function Save($userId, $type, $itemId) {
        date_default_timezone_set("Europe/Riga");
        $notificationId = Core::$Db->Insert('notification', array('user_id' => $userId,'type' => $type, 'item_id' => $itemId, 'is_checked' => 0, 'date' => date('Y-m-d H:i:s', time()), 'user_action' => $_SESSION['user']['id']));
        return $notificationId;
    }

    public function GetList($userId) {
        $list = Core::$Db->SelectJoin('notification', 'notification.type, notification.date, user_data.image, user_data.user_id, user_data.name, user_data.surname', array('notification.user_id' => $userId), array('notification.date'), 'DESC', null, array('user_data' => array('user_data.user_id' => 'notification.user_action')));
        return $list;
    }

    public function GetNew($userId, $startDate) {
        return Core::$Db->NewNotification($userId, $startDate);
    }

    public function GetNewNotificationCount($userId) {
        $count = Core::$Db->Select('notification', 'COUNT(id) as count', array('user_id' => $userId, 'is_checked' => 0))[0];
        return $count;
    }

    public function SetChecked($userId) {
        Core::$Db->UpdateNotification($userId);
    }
}