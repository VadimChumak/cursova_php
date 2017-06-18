<?php
class File_Model
{
    public function GetFileList($user) {
        $List = Core::$Db->Select('file', 'id,url,title', array('user_id' => $user['id']),
            'user_file',array('file.id' => 'file_id'),null, array('date'), array(true));
        return $List;
    }

    public function getUserFileIdList($user){
        $List = Core::$Db->Select('user_file', 'file_id', array('user_id' => $user['id']));
        return $List;
    }

    public function GetFileById($id){
        $song = Core::$Db->Select("file", "url,title", array('id' => $id));
        return $song[0];
    }

    public function AddFile($arr){
        $id = Core::$Db->Insert("file", array('title' => $arr['title'], 'url' =>  $arr['url'], 'date' =>  $arr['date'] ));
        return $id;
    }

    public function AddOwner($userId, $musicId){
        $id = Core::$Db->Insert("user_file", array('user_id' => $userId, 'file_id' =>  $musicId ));
        return $id;
    }

    public function DeleteOwner($userId, $musicId){
        Core::$Db->DeleteByTwoCays("user_file", 'user_id',  $userId , 'file_id', $musicId);
    }
}