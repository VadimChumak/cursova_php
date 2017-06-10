<?php
class News_Model
{
    public function Save($item) {
        date_default_timezone_set("Europe/Riga");
        $arrayForSave = array('post_text' => $item['newsText'], 'owner_id' => $_SESSION['user']['id'], 'publishing_date' => date('Y-m-d H:i:s', time()), 'page_type' => $item['pageType'], 'page_owner_id' => $item['ownerId'], );
        if(isset($item['imageName'])) {
            $imageName = $item['imageName'];
            move_uploaded_file($item['imageTmp'], $_SERVER['DOCUMENT_ROOT'] . "/media/users/" . $item['ownerId']. "/photo/" . $imageName);
            $arrayForSave['photo_url'] = $imageName;
        }
        $id = Core::$Db->Insert("post", $arrayForSave);
        $userInfo = Core::$Db->Select('user_data', array('user_id', 'name', 'surname', 'image'), array('user_id' => $_SESSION['user']['id']));
        $arrayForSave['user_id'] = $userInfo[0]['user_id'];
        $arrayForSave['name'] = $userInfo[0]['name'];
        $arrayForSave['surname'] = $userInfo[0]['surname'];
        $arrayForSave['image'] = $userInfo[0]['image'];
        $arrayForSave['id'] = $id;
        return $arrayForSave;
    }
}