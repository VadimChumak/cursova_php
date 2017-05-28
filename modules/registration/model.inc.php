<?php
class Registration_Model
{
    public function AddUser($item) {
        $registered_users = Core::$Db->Select('user_auth', 'email', array('email' => $item['email']));
        if (empty($registered_users)) {
            Core::$Db->Insert("user_auth", array('email' => $item['email'], 'password' => md5($item['password'])));
            $id = Core::$Db->Select("user_auth", "id", array('email' => $item['email']));
            Core::$Db->Insert('user_data', array('user_id' => $id[0]['id'], 'name' => $item['name'], 'surname' => $item['surname']));
            $this->Authorise(array(
                'id' => $id[0]['id'],
                'email' => $item['email'],
                'name' => $item['name'],
                'surname' => $item['surname']
            ));
            return true;
        }
        return false;
    }
    public  function Authorise($item) {
        $_SESSION['user'] = $item;
    }
    public function Login($item) {
        $current_user = Core::$Db->Select('user_auth', 'id, email, password', array('email' => $item['email'],
            'password' => md5($item['password'])));
        if (!empty($current_user)) {
            $user_data = Core::$Db->Select('user_data', 'name, surname', array('user_id' => $current_user[0]['id']));
            $this->Authorise(array(
                'id' => $current_user[0]['id'],
                'email' => $current_user[0]['email'],
                'name' => $user_data[0]['name'],
                'surname' => $user_data[0]['surname']
            ));
            return true;    
        }
        return false;
    }
}