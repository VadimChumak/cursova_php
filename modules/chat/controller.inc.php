<?php
class Chat_Controller
{
    public function SetAction() {
        session_write_close();
        $limit = 360;
        $time = time();
        $user_id = $_POST['user_id'];
        $date = $_POST['date'];
        set_time_limit($limit + 5);
        while((time() - $time) < $limit ) {
            $message = Core::$Db->NewMessages($user_id, $date);
            if(!empty($message)) {
                $res = json_encode($message);
                echo $res;
                exit();
            }
            sleep(1);
        }
        exit();
    }

    public function SaveAction() {
        $chatModel = new Chat_Model();
        date_default_timezone_set("Europe/Riga");
        $arrayForSave = array();
        $arrayForSave['sender_id'] = $_SESSION['user']['id'];
        $arrayForSave['reciever_id'] = $_POST['recieverId'];
        $arrayForSave['text'] = urldecode($_POST['text']);
        $arrayForSave['is_readed'] = 0;
        $arrayForSave['Date'] = date('Y-m-d H:i:s', time());
        $chatModel->Save($arrayForSave);
        $res =  json_encode($arrayForSave);
        echo $res;
        exit();
    }

    public function MessagesAction() {
        $chatView = new Chat_View();
        $userModel = new User_Model();
        $chatModel = new Chat_Model();
        $model = new Notification_Model();
        $user = $userModel->GetUser((array($_SESSION['user']['id'])));
        $result = $chatModel->UsersList();
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $chatView->MessagesList($result),
            'MessagesCount' => $chatModel->GetNewMessagesCount($_SESSION['user']['id']),
            'PageOwnerId' => $_SESSION['user']['id'],
            'NotificationsCount' => $model->GetNewNotificationCount($_SESSION['user']['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function ListAction() {
        $model = new Chat_Model();
        $firstUser = $_POST['userId'];
        $model->SetReaded($firstUser);
        $messages = $model->MessagesList($firstUser);
        $result = json_encode($messages);
        echo $result;
        exit();
    } 
}