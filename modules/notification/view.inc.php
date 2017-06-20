<?php
class Notification_View
{
    public function NotificationList($notificationList) {
        $messagesTPL = new Template("template/notification/list.tpl");
        $messagesTPL->SetParams($notificationList);
        return $messagesTPL->GetHTML();
    }
}