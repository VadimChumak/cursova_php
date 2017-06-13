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
        $newsList['UserInfo'] = $user[0];
        $newsList['CurrentUser'] = $_SESSION['user'];
        for($i = 0; $i <count($newsList['newsArray']); $i++) {
            if(empty(Core::$Db->SelectJoin('bookmarks', '*', array('item_id' => $newsList['newsArray'][$i]['id'], 'user_id' => $_SESSION['user']['id']), null,  null, null, null, null))) {
                $newsList['newsArray'][$i]['isLiked'] = false;
            }
            else {
                $newsList['newsArray'][$i]['isLiked'] = true;
            }
            $newsList['newsArray'][$i]['comment_count'] = Core::$Db->SelectJoin('comment', 'COUNT(item_id) as count', array('item_id' => $newsList['newsArray'][$i]['id']))[0]['count'];
            $newsList['newsArray'][$i]['images'] = Core::$Db->SelectJoin("post_element", "photo.title", array('post_element.post_id' => $newsList['newsArray'][$i]['id'], 'post_element.element_type' => 'photo'), null, null, null, array('photo' => array('photo.id' => 'post_element.element_id')));
            $newsList['newsArray'][$i]['audios'] = Core::$Db->SelectJoin("post_element", "music.title", array('post_element.post_id' => $newsList['newsArray'][$i]['id'], 'post_element.element_type' => 'music'), null, null, null, array('music' => array('music.id' => 'post_element.element_id')));
            $newsList['newsArray'][$i]['videos'] = Core::$Db->SelectJoin("post_element", "video.title", array('post_element.post_id' => $newsList['newsArray'][$i]['id'], 'post_element.element_type' => 'video'), null, null, null, array('video' => array('video.id' => 'post_element.element_id')));

        }
        $NewsView = new News_View();
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $NewsView->GetNewsList($newsList),
            'AboutSection' => $userPage->GetUserInfo(array('item' => $user[0]))
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }
}