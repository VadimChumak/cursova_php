<?php
class User_Controller
{
    public function IdAction($id) {
        $userModel = new User_Model();
        $user = $userModel->GetUser($id);
        if(empty($user)) {
            return array(
            "Content"  => "404"
        );
        }
        $newsList['newsArray'] = Core::$Db->SelectNumberOfRecords("post", "*", "0", "10", array('page_owner_id' => $id[0]), array("publishing_date"));
        $NewsView = new News_View();
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $NewsView->GetNewsList($newsList)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }
}