<?php
class Photo_Model
{
    public function GetVideoList($user) {
        $List = Core::$Db->Select('video', '*', array('user_id' => $user['id']),
            'user_video',array('video.id' => 'video_id'), array('video.id')   );
        return $List;
    }

    public function getUserVideoIdList($user){
        $List = Core::$Db->Select('user_video', 'video_id', array('user_id' => $user['id']));
        return $List;
    }

    public function AddVideo($arr){
        $id = Core::$Db->Insert("video", array('title' => $arr['title'], 'url' =>  $arr['url'] ));
        return $id;
    }

    public function AddOwner($userId, $musicId){
        $id = Core::$Db->Insert("user_video", array('user_id' => $userId, 'video_id' =>  $musicId ));
        return $id;
    }

    public function DeleteOwner($userId, $musicId){
        Core::$Db->DeleteByTwoCays("user_video", 'user_id',  $userId , 'video_id', $musicId);
    }
}