<?php
class Notification_Controller{
    public function ListAction() {
        $userId = $_SESSION['user']['id'];
        $model = new Notification_Model();
        $view = new Notification_View();
        $chatModel = new Chat_Model();
        $userModel = new User_Model();
        $user = $userModel->GetUser((array($_SESSION['user']['id'])));
        $userPage = new User_View();
        $model->SetChecked($_SESSION['user']['id']);
        $notificationList['notificationArray'] = $model->GetList($userId);
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $view->NotificationList($notificationList),
            'MessagesCount' => $chatModel->GetNewMessagesCount($_SESSION['user']['id']),
            'PageOwnerId' => $_SESSION['user']['id'],
            'NotificationsCount' => array('count' => 0)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params),
        );
    }

    public function CheckAction() {
        session_write_close();
        $limit = 360;
        $time = time();
        $user_id = $_SESSION['user']['id'];
        $date = $_POST['date'];
        set_time_limit($limit + 5);
        $notificationModel = new Notification_Model();
        while((time() - $time) < $limit ) {
            $notification = $notificationModel->GetNew($user_id, $date);
            if(!empty($notification)) {
                $res = json_encode($notification);
                echo $res;
                exit();
            }
            sleep(1);
        }
        exit();
    }
}