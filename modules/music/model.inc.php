<?php
class Music_Model
{
    public function GetMusicList($user) {
        $List = Core::$Db->Select('music', 'id,url,title', array('user_id' => $user['id']),
            'user_music',array('music.id' => 'music_id'), array('music.id')   );
        return $List;
    }

    public function getUserMusicIdList($user){
        $List = Core::$Db->Select('user_music', 'music_id', array('user_id' => $user['id']));
        return $List;
    }

}