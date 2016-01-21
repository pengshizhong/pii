<?php
namespace vendor\db;

use vendor\core\Object;
use vendor\core\Pii;

class TableInfoPool extends Object{
    private $_pools=[];
    private static $_tableInfoPool = null;

    private function __construct()
    {
        echobr('第一次实例化tableinfopool');
    }

    public function getTableInfo($tableName)
    {
//        var_dump($this->_pools);
//        exit;
        if (array_key_exists($tableName,$this->_pools)) {
            return $this->_pools[$tableName];
        } else {
            return $this->_pools[$tableName] = $this->_createTableInfo($tableName);
        }
    }

    private function _createTableInfo($tableName)
    {
        echobr('表的缓冲池没有表信息，开始实例化表信息');
        $tmpInfo =  Pii::app()->db->getTableInfo($tableName);
        $properties = [];
//        var_dump($tmpInfo);
        foreach ( $tmpInfo as $info) {
            $properties[$info['Field']] = $info['Default'];
            if ($info['Key']=='PRI') {
                $pk = $info['Field'];
            }
        }
        $tableInfo['pk'] = $pk;
        $tableInfo['properties'] = $properties;
        return $tableInfo;
    }



    public function getInstance()
    {
        if (!is_null(self::$_tableInfoPool)) {
            return self::$_tableInfoPool;
        } else {
            return new self;
        }
    }
}