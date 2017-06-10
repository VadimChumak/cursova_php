<?php
class Chat_Model
{
    public function Save($item) {
        Core::$Db->Insert("mesages", $item);
    }
}