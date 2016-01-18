<?php
namespace vendor\db;

use vendor\core\Pii;
use vendor\core\PiiException;
use vendor\core\SingleFactory;

class DbFactory extends SingleFactory
{
    private $_instance = [];
    private static $_factory  = null;

    private function __construct(){

    }

    public function getInstance(){
        if(!is_null(self::$_factory)){
            return self::$_factory;
        }
        else {
            return self::$_factory = new self;
        }
    }

    public function getDbInstance()
    {
        $dbInfo = $this->_getDbInfo();
        $idKey = md5($dbInfo);
        if (array_key_exists($idKey,$this->_instance)) {
            return $this->_instance[$idKey];
        } else {
            $this->_instance[$idKey] = $this->_createInstance($dbInfo);
        }
    }

    private function _getDbInfo(){
        $config = Pii::app()->config;
        $dbInfo = $config->getValue('db','db');
        if(!$dbInfo){
            throw new PiiException('there is no db info in config');
        }
    }

    /**
     * @param config = [
     *      'dbType'    => 'mysql',
     *      'localhost' => 'localhost',
     *      'user'      => 'root',
     *      'password'  => '',
     *       ]
     */
    private function _createInstance($config)
    {
        echobr('开始创建数据库实例');
        $className = '\vendor\db\\' . ucfirst($config['dbType']) . '\\' . ucfirst($config['dbType']) . '.php';
        return new $className($config);
    }

}