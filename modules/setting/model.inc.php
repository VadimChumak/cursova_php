<?php
class Setting_Model
{
    public function Edit($item)
    {
        $image = "";
        if($item['gender'] == 0) {
            $image = "default_w.png";
        } 
        else {
            $image = "default_m.png";
        }
        $arrayFoeSave = array( 
            'gender' => $item['gender'], 
            'city' => $item['city'],
            'country' => $item['country'], 
            'image' => $image, 
            'about' => $item['about']
        );
        if(strlen($item['birthday']) > 0 ) {
            $arrayFoeSave['birthday'] = $item['birthday'];
        }
        Core::$Db->UpdateById('user_data', $arrayFoeSave, 'user_id', $_SESSION['user']['id']);
        return true;
    }
    public function GetInfo($id)
    {
        return Core::$Db->Select('user_data', '*', array('user_id' => $id));
    }
    public function SaveAvatar($photo) {
        if ($photo['error']== UPLOAD_ERR_OK)
        {
            $name = strtolower($photo['name']);
            move_uploaded_file($photo['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/media/users/" . $_SESSION['user']['id']. "/photo/" . $name);
            Core::$Db->UpdateById('user_data', array('image' => $name), 'user_id', $_SESSION['user']['id']);
            return $name;
        }
    }
}