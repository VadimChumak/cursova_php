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
    public function AcceptAction()
    {
        $view = new Friends_View();
        $userModel = new User_Model();
        $model = new Friends_Model();
        $res['userArray'] = $model->Accept();
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