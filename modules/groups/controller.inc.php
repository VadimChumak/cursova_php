<?php
class Groups_Controller
{
    public static function ListAction($arg)
    {

        $id = $arg;
        $userModel = new Registration_Model();


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
        $view = new Groups_View();
        $user = $_SESSION['user'];
        $core = new Core();

        if ($_SERVER['REQUEST_METHOD'] != "POST" ) {
            header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/list/".$user[0]['id']);
        }

        if(isset($_POST['title'])) {
            $arr = array(
                'title' => $_POST['title'],
                'photo_url' => "/media/system/photo/base.jpg"
            );
            $model->AddGroup($user, $arr);
            $groupId = $model->IdLastCreatedGroupByUser($user);
            $group = $model->GetGroup($groupId);

            $core->CreateDir('media/groups/', $groupId);
            $core->CreateDir('media/groups/'.$groupId."/",'photo');
        }
        else{
            header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/list/".$user[0]['id']);
        }
        //add more validation
        if (isset($_FILES['photo_url'])) {
            if($_FILES['photo_url']['type'] != 'png' &&  $_FILES['photo_url']['type'] != 'jpg') {
                header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/list/".$user[0]['id']);
            }

            //load new to the server
            $name = $core->saveToDir("media/groups/" . $groupId . "/photo/",
                $_FILES['photo_url']);

            if ($name != -1) {

                $arr = array(
                    'title' => $_POST['title'],
                    'photo_url' => "/media/groups/".$groupId."/photo/" . $name
                );
                $model->Edit($arr,$group);
            }
        } else {
            $arr = array(
                'title' => $_POST['title']
            );
            $model->Edit($arr,$group);
        }

        header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/list/".$user[0]['id']);
    }

    public static function GroupAction($arg)
    {
        $userModel = new Registration_Model();
        $model = new Groups_Model();
        $view = new Groups_View();

        $user = $_SESSION['user'];
        $model->IdLastCreatedGroupByUser($user);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
           //print_r($_POST);
        }

        $groupId = ($arg[0]);

        //404
        if(!$model->isGroupExistById($groupId)){
            //call 404 page
            echo 'not exist';
        }

        $group = $model->GetGroup($groupId);
        $isMember = $model->isMember($group, $user);
        $isAdmin = $model->isGroupAdmin($group, $user);

        $modelUser = new User_Model();
        $userPage = new User_View();
        $userInPage = $modelUser->GetUser((array($_SESSION['user']['id'])));

        $params = array(
            "PageTitle" => $group['title'],
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $userInPage[0],
            'NewsSection' => $view->Group($group, $isMember, $isAdmin)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
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
            header("Location:/");
        }

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if(!$model ->isGroupAdmin($group, $user)){
            header("Location:".$_SERVER["DOCUMENT_ROOT"]."/groups/group/".$groupId);
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if($model->isGroupAdmin($group, $user)) {

                if(isset($_FILES['photo_url'])) {

                    //load new to the server
                    $name = $core->saveToDir("media/groups/".$groupId."/photo/",
                        $_FILES['photo_url']);

                    if($name != -1) {
                        //delete old img
                        $ms = explode("/", $group[0]['photo_url']);
                        $core->deleteFile("media/groups/".$groupId."/photo/",
                            $ms[count($ms)-1]);


                        //check '/media' is correct in linux
                        $arr = array(
                            'title' => $_POST['title'],
                            'photo_url' => "/media/groups/".$groupId."/photo/".$name
                        );
                        $model->Edit($arr,$group);
                    }
                }
                else{
                    $arr = array(
                        'title' => $_POST['title']
                    );
                    $model->Edit($arr,$group);
                }
            }
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

    public function EditPageAction(){}
}