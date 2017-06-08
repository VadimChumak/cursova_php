<?php
class Search_Controller
{
    public function findAction()
    {
        $search = $_GET['search'];
        $m = new Search_Model();
        $peoples = $m->GetPeoples($search);
        $groups = $m->GetGroups($search);
        echo json_encode($peoples);
        //echo json_encode($groups);
        die();
    }
}