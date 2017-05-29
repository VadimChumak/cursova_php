<?php
class Setting_Model
{
    public function Edit($item)
    {
       if ($_FILES && $_FILES['photo']['error'] == UPLOAD_ERR_OK)
        {
            $image_name = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/media/users/" . $_SESSION['user']['id'] . "/photo/" . $image_name);
        }
        else {
            $image_name = "default.png";
        }
        Core::$Db->UpdateById('user_data', array('birthday' => $item['birthday'], 'gender' => $item['gender'], 'city' => $item['city'],
            'country' => $item['country'], 'image' => $image_name, 'about' => $item['about']), 'user_id', $_SESSION['user']['id']);
        return true;
    }
    public function GetInfo($id)
    {
        return Core::$Db->Select('user_data', '*', array('user_id' => $id));
    }
}