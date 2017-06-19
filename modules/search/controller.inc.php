<?php
class Search_Controller
{
    public function findAction()
    {
        $search = $_GET['search'];
        $m = new Search_Model();
        $peoples = $m->GetPeoples($search);
        $groups = $m->GetGroups($search);
        $res = array_merge($peoples, $groups);
        echo json_encode($res);
        die();
    }
}