<?php
//error_reporting(0);
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

    public  function saveImgToDir($dirPath, $imgFile){ //. . . ned some more validation
        // $imgFile = $FILES['name'];
        $path = $dirPath; // директория для загрузки
        $ext = array_pop(explode('.',$imgFile['name'])); // расширение
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением

        if($imgFile['error'] == 0){
            if(move_uploaded_file($imgFile['tmp_name'], $full_path)){
                return $new_name;
            }
        }

        return -1;
    }

    function deleteFile($directory,$filename)
    {
        // открываем директорию (получаем дескриптор директории)
        $dir = opendir($directory);
        // считываем содержание директории
        while(($file = readdir($dir)))
        {
            // Если это файл и он равен удаляемому ...
            if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename"))
            {
                // ...удаляем его.
                unlink("$directory/$file");
                // Если файла нет по запрошенному пути, возвращаем TRUE - значит файл удалён.
                if(!file_exists($directory."/".$filename)) return $s = TRUE;
            }
        }
        // Закрываем дескриптор директории.
        closedir($dir);
    }

    function CreateDir($path ,$name){
        mkdir($path.$name, 0777);
    }
}