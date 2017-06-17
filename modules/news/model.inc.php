<?php
class News_Model
{
    public function Save($item) {
        date_default_timezone_set("Europe/Riga");
        $arrayForSave = array('post_text' => $item['newsText'], 'owner_id' => $_SESSION['user']['id'], 'publishing_date' => date('Y-m-d H:i:s', time()), 'page_type' => $item['pageType'], 'page_owner_id' => $item['ownerId'], );
        $id = Core::$Db->Insert("post", $arrayForSave);
        if(isset($item['images'])) {
            for($i = 0; $i < count($item['images']['name']); $i++) {
                $photoId = Core::$Db->Insert("photo", array('title' => $item['images']['name'][$i], 'date' => date('Y-m-d H:i:s', time())));
                Core::$Db->Insert("user_photo", array('user_id' => $arrayForSave['owner_id'], 'photo_id' => $photoId));
                Core::$Db->Insert("post_element", array('post_id' => $id, 'element_id' => $photoId, 'element_type' => 'photo'));
                move_uploaded_file($item['images']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/media/users/" . $item['ownerId']. "/photo/" . $item['images']['name'][$i]);
                $arrayForSave['images']['name'][$i] = $item['images']['name'][$i];
            }
        }
        if(isset($item['audios'])) {
            $musicModel = new Music_model();
            for($i = 0; $i < count($item['audios']['name']); $i++) {
                $audioId = $musicModel->AddMusic(array('title' => $item['audios']['name'][$i], 'url' => null, 'date' => date('Y-m-d H:i:s', time())));
                $musicModel->AddOwner($_SESSION['user']['id'], $audioId);
                Core::$Db->Insert("post_element", array('post_id' => $id, 'element_id' => $audioId, 'element_type' => 'music'));
                move_uploaded_file($item['audios']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . "/media/music/" . $item['audios']['name'][$i]);
                $arrayForSave['audios']['name'][$i] = $item['audios']['name'][$i];
            }
        }
        if(isset($item['videos'])) {
            $videoModel = new Video_model();
            for($i = 0; $i < count($item['videos']['name']); $i++) {
                $videoId = $videoModel->AddVideo(array('title' => $item['videos']['name'][$i], 'url' => null, 'date' => date('Y-m-d H:i:s', time())));
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

    public function DeleteNews($id) {
        Core::$Db->DeleteById("post", "id", $id);
    }

    public function NewsList($startFrom, $owner, $type) {
        $newsList=Core::$Db->SelectPosts($owner, $type, $startFrom);
        for($i = 0; $i <count($newsList); $i++) {
            if(empty(Core::$Db->SelectJoin('bookmarks', '*', array('item_id' => $newsList[$i]['id'], 'user_id' => $_SESSION['user']['id']), null,  null, null, null, null))) {
                $newsList[$i]['isLiked'] = false;
            }
            else {
                $newsList[$i]['isLiked'] = true;
            }
            if($owner == $_SESSION['user']['id']) {
                $newsList[$i]['is_owner'] = true;
            }
            else {
                $newsList[$i]['is_owner'] = false;
            }
            $newsList[$i]['comment_count'] = Core::$Db->SelectJoin('comment', 'COUNT(item_id) as count', array('item_id' => $newsList[$i]['id']))[0]['count'];
            $newsList[$i]['images'] = Core::$Db->SelectJoin("post_element", "photo.title", array('post_element.post_id' => $newsList[$i]['id'], 'post_element.element_type' => 'photo'), null, null, null, array('photo' => array('photo.id' => 'post_element.element_id')));
            $newsList[$i]['audios'] = Core::$Db->SelectJoin("post_element", "music.title", array('post_element.post_id' => $newsList[$i]['id'], 'post_element.element_type' => 'music'), null, null, null, array('music' => array('music.id' => 'post_element.element_id')));
            $newsList[$i]['videos'] = Core::$Db->SelectJoin("post_element", "video.title", array('post_element.post_id' => $newsList[$i]['id'], 'post_element.element_type' => 'video'), null, null, null, array('video' => array('video.id' => 'post_element.element_id')));

        }
        return $newsList;
    }

    public function ToggleLike($postId, $action) {
        if($action == "set") {
            Core::$Db->Insert('bookmarks', array('user_id' => $_SESSION['user']['id'], 'item_id' => $postId));
                    }
        else {
            Core::$Db->DeleteByTwoCays("bookmarks", 'item_id', $postId, 'user_id', $_SESSION['user']['id']);
        }
    }

    public function LikeCount($postId) {
        $likeCount = 0;
        $likeCount = Core::$Db->SelectJoin('bookmarks', array('COUNT(item_id) as count'), array('item_id' => $postId));
        return $likeCount;
    }

    public function AddComment($postId, $text) {
        date_default_timezone_set("Europe/Riga");
        $arrayForSave = array('item_id' => $postId, 'item_type' => 'post', 'user_id' => $_SESSION['user']['id'], 'text' => $text, 'date' => date('Y-m-d H:i:s', time()));
        $commentId = Core::$Db->Insert("comment", $arrayForSave);
        $arrayForSave['id'] = $commentId;
        return $arrayForSave;
    }

    public function CommentList($postId) {
        $comments = Core::$Db->SelectJoin("comment", array('user_data.image', 'user_data.name', 'user_data.user_id', 'user_data.surname', 'comment.text', 'comment.date', 'comment.id'), array('item_id' => $postId), array('date'), null, null, array('user_data' => array('user_data.user_id' => 'comment.user_id')), null);
        for($i = 0; $i < count($comments); $i++) {
            if($_SESSION['user']['id'] == $comments[$i]['user_id']) {
                $comments[$i]['is_owner'] = true;
            }
            else {
                $comments[$i]['is_owner'] = true;
            }
        }
        return $comments;
    }
}