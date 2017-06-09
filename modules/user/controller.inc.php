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
        $newsList['newsArray'] = Core::$Db->SelectPosts($user[0]['user_id'], 'user', 0);
        for($i = 0; $i <count($newsList['newsArray']); $i++) {
            if(empty(Core::$Db->SelectJoin('bookmarks', '*', array('item_id' => $newsList['newsArray'][$i]['id'], 'user_id' => $_SESSION['user']['id']), null,  null, null, null, null))) {
                $newsList['newsArray'][$i]['isLiked'] = false;
            }
            else {
                $newsList['newsArray'][$i]['isLiked'] = true;
            }
        }
        $newsList['UserInfo'] = $user[0];
        $newsList['CurrentUser'] = $_SESSION['user'];
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