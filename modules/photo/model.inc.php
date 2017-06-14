<?php
class Photo_Model
{
    public function GetPhotoList($user) {
        $List = Core::$Db->Select('photo', '*', array('user_id' => $user['id']),
            'user_photo',array('photo.id' => 'photo_id'),null, array('date'), array(true)   );
        return $List;
    }

    public function getUserPhotoIdList($user){
        $List = Core::$Db->Select('user_photo', 'photo_id', array('user_id' => $user['id']));
        return $List;
    }

    public function AddPhoto($arr){
        $id = Core::$Db->Insert("photo", array('title' => $arr['title'], 'url' =>  $arr['url'] , 'date' =>  $arr['date'] ));
        return $id;
    }

    public function  AddAlbum($arr){
        $id = Core::$Db->Insert("album", array('title' => $arr['title'], 'user_id' =>  $arr['user_id']));
        return $id;
    }

    public function  GetAlbumOwner($id){
        $owner = Core::$Db->Select("album", "*", array('user_id' => $id) );
        return $owner[0];
    }

    public function GetAlbumPhotoList($id){
        $List = Core::$Db->Select('photo', '*', array('user_id' => $id),
            'photo_album',array('photo.id' => 'photo_id'),null, array('date'), array(true)   );
        return $List;
    }

    public function AddOwner($userId, $musicId){
        $id = Core::$Db->Insert("user_photo", array('user_id' => $userId, 'photo_id' =>  $musicId ));
        return $id;
    }

    public function DeleteOwner($userId, $musicId){
        Core::$Db->DeleteByTwoCays("user_photo", 'user_id',  $userId , 'photo_id', $musicId);
    }
}