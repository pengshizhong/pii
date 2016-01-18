<?php
function getClassFile($className)
{   //echobr($className);
    $configs = \vendor\core\Pii::app()->config;
    foreach ($configs as $config) {
        var_dump($config);
        if(array_key_exists($className,$config)){
            $fileName = dirname(__DIR__) . $config[$className] . $className .  '.php';
            echobr($fileName);
            if (file_exists($fileName)) {
                return $fileName;
            }
        }
    }
    return false;
}

function autoload($className)
{
    $fileName = dirname(__DIR__) . '/' . str_replace('\\','/',$className) . '.php';
    //echo $fileName ."<br>";
    //echo $fileName;
    if (file_exists($fileName)) {
        include $fileName;
        //echo $className . '<br>';
        //只要require文件就可以了我擦...
        //return new $className;
    } else {
        $fileName = getClassFile($className);
        if($fileName){
            include $fileName;
        }
    }
}

spl_autoload_register('autoload');
