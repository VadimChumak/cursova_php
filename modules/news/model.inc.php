<?php
class News_Model
{
    public function Save($item) {
        date_default_timezone_set("Europe/Riga");
        $arrayForSave = array('post_text' => $item['newsText'], 'owner_id' => $_SESSION['user']['id'], 'publishing_date' => date('Y-m-d H:i:s', time()), 'page_type' => $item['pageType'], 'page_owner_id' => $item['ownerId'], );
        $id = Core::$Db->Insert("post", $arrayForSave);
        if(isset($item['images'])) {
            for($i = 0; $i < count($item['images']['name']); $i++) {
                $photoId = Core::$Db->Insert("photo", array('title' => $item['images']['name'][$i]));
                Core::$Db->Insert("user_photo", array('user_id' => $arrayForSave['owner_id'], 'photo_id' => $photoId));
                Core::$Db->Insert("post_element", array('post_id' => $id, 'element_id' => $photoId, 'element_type' => 'photo'));
                move_uploaded_file($item['images']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/media/users/" . $item['ownerId']. "/photo/" . $item['images']['name'][$i]);
                $arrayForSave['images']['name'][$i] = $item['images']['name'][$i];
            }
        }
        if(isset($item['audios'])) {
            $musicModel = new Music_model();
            for($i = 0; $i < count($item['audios']['name']); $i++) {
                $audioId = $musicModel->AddMusic(array('title' => $item['audios']['name'][$i], 'url' => null));
                $musicModel->AddOwner($_SESSION['user']['id'], $audioId);
                Core::$Db->Insert("post_element", array('post_id' => $id, 'element_id' => $audioId, 'element_type' => 'music'));
                move_uploaded_file($item['audios']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/media/music/" . $item['audios']['name'][$i]);
                $arrayForSave['audios']['name'][$i] = $item['audios']['name'][$i];
            }
        }
        if(isset($item['videos'])) {
            $videoModel = new Video_model();
            for($i = 0; $i < count($item['videos']['name']); $i++) {
                $videoId = $videoModel->AddVideo(array('title' => $item['videos']['name'][$i], 'url' => null));
                $videoModel->AddOwner($_SESSION['user']['id'], $videoId);
                Core::$Db->Insert("post_element", array('post_id' => $id, 'element_id' => $videoId, 'element_type' => 'video'));
                move_uploaded_file($item['videos']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/media/video/" . $item['videos']['name'][$i]);
                $arrayForSave['videos']['name'][$i] = $item['videos']['name'][$i];
            }
        }
        $userInfo = Core::$Db->Select('user_data', array('user_id', 'name', 'surname', 'image'), array('user_id' => $_SESSION['user']['id']));
        $arrayForSave['user_id'] = $userInfo[0]['user_id'];
        $arrayForSave['name'] = $userInfo[0]['name'];
        $arrayForSave['surname'] = $userInfo[0]['surname'];
        $arrayForSave['image'] = $userInfo[0]['image'];
        $arrayForSave['id'] = $id;
        return $arrayForSave;
    }
}