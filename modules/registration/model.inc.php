<?php
class Registration_Model
{
    public function AddUser($item) {
        $registered_users = Core::$Db->Select('user_auth', 'email', array('email' => $item['email']));
        if (empty($registered_users)) {
            $cur_id = Core::$Db->Insert("user_auth", array('email' => $item['email'], 'password' => $item['password']));
            Core::$Db->Insert('user_data', array('user_id' => $cur_id, 'name' => $item['name'], 'surname' => $item['surname']));
            return true;
        }
        return false;
    }
}