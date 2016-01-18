<?php
function getAlias($alias)
{

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
        $dirPrefix = getAlias('');
        if($dirPrefix) {

        } else {
        }
    }
}

spl_autoload_register('autoload');
