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
            $message = Core::$Db->SelectMessages($user_id);
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
}