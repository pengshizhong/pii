<?php
namespace vendor\db\mysql;

use vendor\core\PiiException;
use vendor\db\ActiveRecord;
use vendor\db\DbAbstract;
use \PDO;
//为调试方便暂时不继承抽象类
class Mysql {
    private $_connection;
    private $_queryBuilder;

    public function __construct($dbInfo)
    {
        $this->_connect($dbInfo);
        $this->_queryBuilder = new QueryBuilder();
    }

    /**
     * @param $sql
     * @throws PiiException
     * @return false or results
     */
    private function query($sql)
    {
        echobr('start query');
        echobr('sql:' . $sql );
        try {
            $result = $this->_connection->query($sql);
            if ($result) {
                $result = $result->fetchAll();
                echobr('查询完成');
                return $result;
            } else {
                echobr('查询失败');
            }
        }
        catch(\PDOException $e){
            throw new PiiException($e->getMessage());
        }

        //var_dump($result);
    }

    private function _connect($dbInfo)
    {
        echobr('开始建立数据库连接');
        $dsn = $dbInfo['dbType'] . ":host=" . $dbInfo['host'] . ';dbname=' . $dbInfo['dbName'];
        echobr('dsn:' . $dsn);
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::FETCH_ASSOC     => 1,
        ];
        try {
            $this->_connection = new PDO($dsn, $dbInfo['user'], $dbInfo['dbPassword'],$options);
        }
        catch(\PDOException $e){
            throw new PiiException($e->getMessage(),$e->getCode());
        }
        echobr('实例化数据库连接完成');
    }

    public function getTableInfo($tableName)
    {
//        $sql = 'show columns from ' . $tableName;
//        return $this->query($sql);
        $sql = $this->_queryBuilder->getColumns($tableName)->getSql();
        return $this->query($sql);
    }

    public function save(ActiveRecord $ar)
    {
        $sql = $this->_queryBuilder->insert($ar)->getSql();
        return $this->query($sql);
    }

}