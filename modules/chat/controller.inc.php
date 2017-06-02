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
            $message = Core::$Db->SelectJoin("mesages", "*", array('reciever_id' => $user_id, 'is_readed' => 0), array('Date'), 'DESC', null, null, null);
            if(!empty($message)) {
                foreach($message as $item) {
                    Core::$Db->UpdateById("mesages", array('is_readed' => "1"), 'id', $item['id']);
                }
                $res = json_encode($message);
                echo $res;
                exit();
            }
            sleep(5);
        }
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

    public function MessagesAction($id = null) {

    } 
}