<?php
class Chat_Controller
{
    public function SetAction() {
        session_write_close();
        $limit = 360;
        $time = time();
        $user_id = $_POST['user_id'];
        set_time_limit($limit + 5);
        while((time() - $time) < $limit ) {
            $message = Core::$Db->SelectJoin("mesages", array('mesages.id', 'mesages.sender_id', 'mesages.reciever_id', 'mesages.text, user_data.name'), array('reciever_id' => $user_id, 'is_readed' => 0), array('Date'), 'DESC', null, array('user_data' => array('user_data.user_id' => 'mesages.sender_id')), null);
            if(!empty($message)) {
                foreach($message as $item) {
                    Core::$Db->UpdateById("mesages", array('is_readed' => "1"), 'id', $item['id']);
                }
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
        $user = $userModel->GetUser((array($_SESSION['user']['id'])));
        $usersSend = Core::$Db->SelectJoin('mesages', array('DISTINCT user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('mesages.sender_id' => $_SESSION['user']['id']), null, null,  null, array('user_data' => array('mesages.reciever_id' => 'user_data.user_id')), null);
        $usersRecieve = Core::$Db->SelectJoin('mesages', array('DISTINCT user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('mesages.reciever_id' => $_SESSION['user']['id']), null, null,  null, array('user_data' => array('mesages.sender_id' => 'user_data.user_id')), null);
        $result['messagesArray'] = array_merge_recursive(array_diff_assoc($usersSend, $usersRecieve), array_intersect_assoc($usersSend, $usersRecieve));
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $chatView->MessagesList($result)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function ListAction() {
        $firstUser = $_POST['userId'];
        $messages = Core::$Db->SelectMessages($firstUser, $_SESSION['user']['id']);
        $result = json_encode($messages);
        echo $result;
        exit();
    } 
}