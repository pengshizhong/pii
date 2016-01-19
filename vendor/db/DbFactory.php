<?php
namespace vendor\db;

use vendor\core\Pii;
use vendor\core\PiiException;
use vendor\core\SingleFactory;

class DbFactory extends SingleFactory
{
    private static $_instance = [];

    private function __construct(){

    }

    public static function getInstance($key = 'db'){
        $dbInfo = self::_getDbInfo($key);
        $idKey  = md5($dbInfo['host'] . $dbInfo['dbName']);
        if(array_key_exists($idKey,self::$_instance)){
            return self::$_instance[$idKey];
        }
        else{
            $instance = self::_createDbInstance($dbInfo);
            return self::$_instance[$idKey] = $instance;
        }
    }

    private static function _getDbInfo($key){
        $config = Pii::app()->config;
        $dbInfo = $config->getValue($key,'db');
        if(!$dbInfo){
            throw new PiiException('there is no db info in config');
        }
        return $dbInfo;
    }

    /**
     * @param config = [
     *      'dbType'    => 'mysql',
     *      'localhost' => 'localhost',
     *      'user'      => 'root',
     *      'password'  => '',
     *       ]
     */
    private static function _createDbInstance($dbInfo)
    {
        echobr('开始创建数据库实例');
        //var_dump($dbInfo);
        $className = '\vendor\db\\' . $dbInfo['dbType'] . '\\' . ucfirst($dbInfo['dbType']);
        return new $className($dbInfo);
    }

}