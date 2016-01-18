<?php
namespace vendor\db\mysql;

use vendor\core\PiiException;
use vendor\db\DbAbstract;
use \PDO;
//为调试方便暂时不继承抽象类
class Mysql {
    private $_connection;

    public function __construct($dbInfo)
    {
        $this->_connect($dbInfo);
    }

    private function query(){

    }

    private function _connect($dbInfo)
    {
        echobr('开始建立数据库连接');
        $dsn = $dbInfo['dbType'] . ":host=" . $dbInfo['host'] . ';dbname=' . $dbInfo['dbName'];
        echobr('dsn:' . $dsn);
        $options = [
            PDO::ATTR_PERSISTENT => true,
        ];
        try {
            $this->_connection = new PDO($dsn, $dbInfo['user'], '123456',$options);
        }
        catch(\PDOException $e){
            throw new PiiException($e->getMessage(),$e->getCode());
        }
    }
}