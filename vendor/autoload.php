<?php
function getAlias($alias)
{

}

function autoload($className)
{
    $fileName = dirname(__DIR__) . '\\' . $className . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
        return new $className;
    } else {
        $dirPrefix = getAlias('');
        if($dirPrefix) {

        } else {
        }
    }
//    echo $className;
}

spl_autoload_register('autoload');
