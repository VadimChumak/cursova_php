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
}