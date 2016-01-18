<?php
namespace vendor\core;

class ConfigManger extends Object
{
    private static $_configName = [
        'db'       => 'db.php',
        'property' => 'property.php',
        'core'     => 'core.php',
        'alias'    => 'alias.php'
    ];
    private static $_configs = [];

    private function __construct()
    {

    }

    public static function load()
    {

        $baseDir = Pii::app()->appDir;
//        $file=scandir($baseDir.'/config');
//        print_r($file);
//        exit;
        foreach (self::$_configName as $configName => $fileName) {
            if(file_exists($baseDir . 'config/' . $fileName)) {
                $tmp = require_once $baseDir . 'config/' . $fileName;
                self::$_configs[$configName] = $tmp;
            } else {
                throw new PiiException('config file ' . $fileName .' is not exist!');
            }
        }
        return new self;
    }

    public function getValue($key,$configName)
    {
        if(array_key_exists($key,self::$_configs[$configName])){
            return self::$_configs[$configName][$key];
        }
        else{
            return false;
        }
    }

}