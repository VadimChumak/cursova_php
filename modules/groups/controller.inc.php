<?php
class Groups_Controller
{
    public static function ListAction()
    {
        $userModel = new Registration_Model();

        $model = new Groups_Model();
        $view = new Groups_View();

        $user = $_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            /*if(!isset($user[0])) {
                $user = $_POST;
                if ($userModel->AddUser($user)) {
                    return Menu_Controller::CreateAction();
                }
            }*/
            $arr = array(
                'title' => $_POST['title'],
                'photo_url' => $_POST['photo_url']
            );
            //if user exist
            $model->AddGroup($user,$arr);
        }



        $groupList = $model->GetGroupList($user);

        return array(
            "PageTitle" => "Групи",
            'Content' => $view->GroupList($groupList)
        );

    }

    public static function GroupAction($arg)
    {
        $userModel = new Registration_Model();
        $model = new Groups_Model();
        $view = new Groups_View();

        $user = $_SESSION['user'];
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
        //if group does not exist or
        //add user does not exist validation !!!
        if( (!$model->isGroupExistById($groupId))   ) {
            header("Location:/");
        }

        $group = $model->GetGroup($groupId);
        $user = $_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //add more validation
            if($model->isGroupAdmin($group, $user)) {
                $arr = array(
                    'title' => $_POST['title'],
                    'photo_url' => $_POST['photo_url']
                 );
                $model->Edit($arr,$group);

            }
            header("Location:/groups/group/".$groupId);
        }

        if(!$model ->isGroupAdmin($group, $user)){
            //need 404
            //now back to group page
            header("Location:/groups/group/".$groupId);
        }

        return array(
            "PageTitle" => $group['title'].' Edit',
            'Content' => $view->Edit($group)
        );
    }
}