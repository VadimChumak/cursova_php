<?php
class Friends_Controller
{
    public function AddAction()
    {
        $model = new Friends_Model();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST['user_id'];
            $model->AddToFriends($_SESSION['user'], $user);
            exit();
        }
    }
    public function SendersAction()
    {
        $view = new Friends_View();
        $userModel = new User_Model();
        $model = new Friends_Model();
        $res['userArray'] = $model->SendersList();
        $user = $userModel->GetUser((array($_SESSION['user']['id'])));
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $view->Accept($res)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );

    }
    public function AcceptAction() {
        $model = new Friends_Model();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST['user_id'];
            $model->Accept($_SESSION['user'], $user);
            $_SESSION['user']['friends_count'] = $_SESSION['user']['friends_count'] + 1;
            exit();
        }
    }
    public function RemoveAction() {
        $model = new Friends_Model();
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user = $_POST['user_id'];
            $model->Remove($_SESSION['user'], $user);
            $_SESSION['user']['friends_count'] = $_SESSION['user']['friends_count'] - 1;
            exit();
        }
    }
    public function ListAction()
    {
        $view = new Friends_View();
        $userModel = new User_Model();
        $model = new Friends_Model();
        $res['userArray'] = $model->FriendList();
        $user = $userModel->GetUser((array($_SESSION['user']['id'])));
        $userPage = new User_View();
        $params = array(
            'CurrentUser' => $_SESSION['user'],
            'UserInfo' => $user[0],
            'NewsSection' => $view->Accept($res)
        );
        return array(
            "Content"  => $userPage->GetUserPage($params)
        );
    }
}