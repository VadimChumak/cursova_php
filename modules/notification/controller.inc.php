<?php
class Notification_Controller{
    public function ListAction() {
        $userId = $_SESSION['user']['id'];

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