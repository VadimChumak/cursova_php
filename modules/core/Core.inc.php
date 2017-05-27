<?php
class Core
{
    public static $Db;
    public static $IndexTPL;
    public static function Init()
    {
        session_start();
        self::$Db = new Database("localhost", 'social_network', 'root', '');
        self::$IndexTPL = new Template("template/index.tpl");
    }
    public static function Run()
    {
        if (isset($_SESSION['user'])) {
            self::$IndexTPL->SetParam('PageTitle', "Початкова сторінка");
            self::$IndexTPL->SetParam('PageHeaderTitle', "Початкова сторінка");
            $url = $_GET['url'];
            $parts = explode('/', $url);
            if (count($parts) == 1) {
                $moduleObject = new Menu_Controller();
                $params = $moduleObject->CreateAction();
                self::$IndexTPL->SetParams($params);
            }
            else {
                $className = ucfirst(array_shift($parts)).'_Controller';
                $methodName = ucfirst(array_shift($parts)).'Action';
                if (class_exists($className))
                {
                    $moduleObject = new $className();
                    if (method_exists($moduleObject, $methodName))
                    {
                        $params = $moduleObject->$methodName($parts);
                        self::$IndexTPL->SetParams($params);
                    }
                    else
                    {
                        // 404
                    }
                } else
                {
                    // 404
                }
            }

        }
        else {
            $moduleObject = new Registration_Controller();
            $url = $_GET['url'];
            if ($url == 'registration/add') {
                $params = $moduleObject->AddAction();
                self::$IndexTPL->SetParams($params);
            }
            else {
                $params = $moduleObject->LoginAction();
                self::$IndexTPL->SetParams($params);
            }

        }
    }
    public static function Done()
    {
        self::$IndexTPL->Display();
    }
}