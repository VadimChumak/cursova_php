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
        $newsList['newsArray'] = Core::$Db->SelectJoin("post", array('post.id', 'post.post_text', 'post.publishing_date', 'post.photo_url', 'post.page_owner_id', 'user_data.user_id', 'user_data.name', 'user_data.surname', 'user_data.image'), array('page_owner_id' => $id[0], 'page_type' => 'user'), array("publishing_date"), 'DESC', null, array('user_data' => array('user_data.user_id' => 'post.owner_id')), array('from' => 0, 'count' => 10));
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