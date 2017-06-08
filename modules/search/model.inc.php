<?php
class Search_Model
{
    public function GetPeoples($word)
    {
        $data = Core::$Db->SelectSearch('user_data', 'CONCAT(name, "  ", surname) as names, image, user_id as id, "user" as type', array("name" => $word, "surname" => $word));
        return $data;
    }
    public function GetGroups($word)
    {
        $data = Core::$Db->SelectSearch('groups', 'title as names, photo_url as image, id, "group" as type', array("title" => $word));
        return $data;
    }
}