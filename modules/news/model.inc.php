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
        Core::$Db->Insert("post", $arrayForSave);
        return $arrayForSave;
    }
}