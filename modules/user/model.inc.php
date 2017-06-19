<?php
class User_Model
{
    public function GetUser($id) {
        $user = Core::$Db->Select("user_data", "*", array('user_id' => $id[0]));
        return $user;
    }

    public function GetUserAuth($id) {
        $user = Core::$Db->Select("user_auth", "*", array('id' => $id[0]));
        return $user;
    }
}