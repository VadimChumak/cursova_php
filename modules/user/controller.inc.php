<?php
class User_Controller
{
    public function IdAction($id) {
        $chatModel = new Chat_Model();
        $userModel = new User_Model();
        $user = $userModel->GetUser($id);
        if(empty($user)) {
            return array(
            "Content"  => "404"
        );
        }
        $model = new News_Model();
        $newsList['newsArray'] = $model->NewsList(0, $user[0]['user_id'], 'user');
        $newsList['CurrentUser'] = $_SESSION['user'];
        $newsList['OwnerId'] = $user[0]['user_id'];
        $newsList['PageType'] = 'user';
        $NewsView = new News_View();
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $NewsView->GetNewsList($newsList),
            'AboutSection' => $userPage->GetUserInfo(array('item' => $user[0])),
            'MessagesCount' => $chatModel-> GetNewMessagesCount($_SESSION['user']['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params),
            'Script' => $NewsView->Scripts()
        );
    }
}