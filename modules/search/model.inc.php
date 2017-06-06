<?php
class Search_Model
{
    public function GetPeoples($word)
    {
        $data = Core::$Db->SelectSearch('user_data', 'name, surname, image', array("name" => $word, "surname" => $word));
        return $data;
    }
    public function GetGroups($word)
    {
        $data = Core::$Db->SelectSearch('groups', 'title, photo_url', array("title" => $word));
        return $data;
    }
}