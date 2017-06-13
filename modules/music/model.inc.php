<?php
class Music_Model
{
    public function GetMusicList($user) {
        $List = Core::$Db->Select('music', 'id,url,title', array('user_id' => $user['id']),
            'user_music',array('music.id' => 'music_id'),null, array('date'), array(true));
        return $List;
    }

    public function getUserMusicIdList($user){
        $List = Core::$Db->Select('user_music', 'music_id', array('user_id' => $user['id']));
        return $List;
    }

    public function GetSongById($id){
        $song = Core::$Db->Select("music", "url,title", array('id' => $id));
        return $song[0];
    }

    public function AddMusic($arr){
        $id = Core::$Db->Insert("music", array('title' => $arr['title'], 'url' =>  $arr['url'], 'date' =>  $arr['date'] ));
        return $id;
    }

    public function AddOwner($userId, $musicId){
        $id = Core::$Db->Insert("user_music", array('user_id' => $userId, 'music_id' =>  $musicId ));
        return $id;
    }

    public function DeleteOwner($userId, $musicId){
        Core::$Db->DeleteByTwoCays("user_music", 'user_id',  $userId , 'music_id', $musicId);
    }
}