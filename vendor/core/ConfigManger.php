<?php
namespace vendor\core;

class ConfigManger extends Object
{
    private static $_configName = [
        'db' => 'config/db.php',
        'property' => 'config/property.php',
    ];
    private static $_configs = [];

    public static function load()
    {
        $baseDir = Pii::app()->appDir;
        foreach (self::$_configName as $configName => $fileName) {
            if(file_exists($baseDir . $fileName)) {
                $tmp = require_once $baseDir . $fileName;
                self::$_configs[$configName] = $tmp;
            } else {
                throw new PiiException('config file ' . $fileName .' is not exist!');
            }
        }
        return self::$_configs;
    }
}