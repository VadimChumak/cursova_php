<?php
class Groups_Controller
{
    public static function ListAction($arg)
    {
        $modelUser = new User_Model();
        $user = $modelUser->GetUserAuth($arg[0]);

        if($user == null)
            header("Location:".$_SERVER["DOCUMENT_ROOT"]);

        $model = new Groups_Model();
        $view = new Groups_View();

        $CurrentUser = $_SESSION['user'];

        $groupList = $model->GetGroupList($user[0]);
        $userPage = new User_View();
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        $params = array(
            "PageTitle" => "Groups",
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->GroupList($groupList, $user[0], $CurrentUser)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function AddGroupAction()
    {
        $model = new Groups_Model();
        $user = $_SESSION['user'];
        $core = new Core();
        $data = "error";
        $title = $_POST['title'];
        if ($_SERVER['REQUEST_METHOD'] == "POST" && $title!='') {
            if (isset($_POST['title']) ) {
                $arr = array(
                    'title' => $title,
                    'photo_url' => "/media/system/photo/base.jpg"
                );
                $groupId = $model->AddGroup($user, $arr);
                $group = $model->GetGroup($groupId);
                $model->AddUserToGroup($user, $group);
                $core->CreateDir('media/groups/', $groupId);
                $core->CreateDir('media/groups/' . $groupId . "/", 'photo');
                $data = "created";
            } else {
                header("Location:" . $_SERVER["DOCUMENT_ROOT"] . "/groups/list/" . $user[0]['id']);
            }
            //add more validation
            if (isset($_FILES['photo_url'])) {
                //load new to the server
                $name = $core->saveToDir("media/groups/" . $groupId . "/photo/",
                    $_FILES['photo_url']);

                if ($name != -1) {

                    $arr = array(
                        'title' => $_POST['title'],
                        'photo_url' => "/media/groups/" . $groupId . "/photo/" . $name
                    );
                    $model->Edit($arr, $group);
                }
            } else {
                $arr = array(
                    'title' => $title
                );
                $model->Edit($arr, $group);
            }
        }
        echo(json_encode($data));
        exit();
    }

    public static function GroupAction($arg)
    {
        $model = new Groups_Model();
        $view = new Groups_View();

        $user = $_SESSION['user'];
        $model->IdLastCreatedGroupByUser($user);
        $groupId = ($arg[0]);


        if(!$model->isGroupExistById($groupId)){
            header("Location:" . $_SERVER["DOCUMENT_ROOT"]);
        }

        $group = $model->GetGroup($groupId);
        $isMember = $model->isMember($group, $user);
        $isAdmin = $model->isGroupAdmin($group, $user);

        $modelNotifi = new Notification_Model();
        $chatModel = new Chat_Model();

        $modelN = new News_Model();
        $newsList['newsArray'] = $modelN->NewsList(0, $groupId, 'group');
         $newsList['CurrentUser'] = $_SESSION['user'];
         $newsList['OwnerId'] = $groupId;
         $newsList['PageType'] = 'group';
         $newsList['IsAdmin'] = $model->isGroupAdmin($group, $_SESSION['user']);
         $NewsView = new News_View();

        $modelUser = new User_Model();
        $userPage = new User_View();
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        $params = array(
            "PageTitle" => $group[0]['title'],
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'AboutSection' => $view->Group($group, $isMember, $isAdmin),
            'NewsSection' =>  $NewsView->GetNewsList($newsList),
            'PageOwnerId' => $groupId,
            'MessagesCount' => $chatModel->GetNewMessagesCount($_SESSION['user']['id']),
            'NotificationsCount' => $modelNotifi->GetNewNotificationCount($_SESSION['user']['id'])
        );
        return array(
            "Content"  => $userPage->GetUserPage($params),
            "Script" => $NewsView->Scripts()
        );

    }

    public function LeaveOrJoinAction(){

        $data = "error";
        $user = $_SESSION['user'];
        if ($_SERVER['REQUEST_METHOD'] == "POST" && $user!= null && isset($_POST['id'])) {

            $model = new Groups_Model();

            $groupId = $_POST['id'];

            $group = $model->GetGroup($groupId);
            if($model->isMember($group, $user)){
                $model->DeleteByTwoCays($user, $group);
                $data = 'leave';
            }
            else{
                $model->AddUserToGroup($user, $group);
                $data = 'join';
            }
        }
        echo(json_encode($data));
        exit();

    }

    public function EditAction($arg)
    {
        $groupId = ($arg[0]);

        $model = new Groups_Model();
        $view = new Groups_View();
        $core = new Core();

        if( (!$model->isGroupExistById($groupId))   ) {
            header("Location:".$_SERVER["DOCUMENT_ROOT"]);
        }

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if(!$model ->isGroupAdmin($group, $user)){
            header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/group/".$groupId);
        }

        $modelUser = new User_Model();
        $userPage = new User_View();

        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        $params = array(
            "PageTitle" => $group['title'].' Edit',
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->Edit($group)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }

    public function EditGroupAction()
    {
        $model = new Groups_Model();
        $core = new Core();

        $groupId = $_POST['group_id'];
        $data = "error";
        if ((!$model->isGroupExistById($groupId))) {
            $data = "not exist";
        }

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if (!$model->isGroupAdmin($group, $user)) {
            $data = "notAdmin";
        }
        $title = $_POST['title'];
        if ($_SERVER['REQUEST_METHOD'] == "POST" && $model->isGroupAdmin($group, $user) && $model->isGroupExistById($groupId) &&
            $title!='') {
            if (isset($_FILES['photo_url'])) {
                //load new to the server
                $name = $core->saveToDir("media/groups/" . $groupId . "/photo/",
                    $_FILES['photo_url']);
                if ($name != -1) {
                    $ms = explode("/", $group[0]['photo_url']);
                    $core->deleteFile("media/groups/" . $groupId . "/photo/",
                        $ms[count($ms) - 1]);


                    $arr = array(
                        'title' => $title,
                        'photo_url' => "/media/groups/" . $groupId . "/photo/" . $name
                    );
                    $model->Edit($arr, $group);
                    $data = "edited";
                }
            } else {
                $arr = array(
                    'title' => $_POST['title']
                );
                $model->Edit($arr, $group);
                $data = "edited";
            }
        }
        echo(json_encode($data));
        exit();

    }


}