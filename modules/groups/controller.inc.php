<?php
class Groups_Controller
{
    public static function ListAction()
    {
        $userModel = new Registration_Model();

        $model = new Groups_Model();
        $view = new Groups_View();

        $user = $_SESSION['user'];

        $groupList = $model->GetGroupList($user);

        return array(
            "PageTitle" => "Групи",
            'Content' => $view->GroupList($groupList)
        );

    }

    public function AddGroupAction()
    {
        $model = new Groups_Model();
        $view = new Groups_View();
        $user = $_SESSION['user'];
        $core = new Core();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
                header("Location:/groups/list/");
            }
            //add more validation
            if (isset($_FILES['photo_url'])) {
                //load new to the server
                $name = $core->saveToDir("media/groups/" . $groupId . "/photo/",
                    $_FILES['photo_url']);

                if ($name != -1) {
                    //check '/media' is correct in linux
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
        }
        header("Location:/groups/list/");
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
        return array(
            "PageTitle" => $group['title'],
            'Content' => $view->Group($group, $isMember, $isAdmin)
        );
    }

    public function LeaveOrJoinAction($arg){
        $groupId = ($arg[0]);
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            header("Location:/groups/group/".$groupId);
        }
        $model = new Groups_Model();

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if($model->isMember($group, $user)){
            $model->DeleteByTwoCays($user, $group);
        }
        else{
            $model->AddUserToGroup($user, $group);
        }

        header("Location:/groups/group/".$groupId);
    }

    public function EditAction($arg)
    {
        $groupId = ($arg[0]);

        $model = new Groups_Model();
        $view = new Groups_View();
        $core = new Core();
        //if group does not exist or
        //add user does not exist validation !!!
        if( (!$model->isGroupExistById($groupId))   ) {
            header("Location:/");
        }

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if(!$model ->isGroupAdmin($group, $user)){
            //need 404
            //now back to group page
            header("Location:/groups/group/".$groupId);
        }

        //save new info
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //add more validation
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
            header("Location:/groups/group/".$groupId);
        }

        return array(
            "PageTitle" => $group['title'].' Edit',
            'Content' => $view->Edit($group)
        );
    }
}