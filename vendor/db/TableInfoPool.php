<?php
namespace vendor\db;

use vendor\core\App;
use vendor\core\Object;

class TableInfoPool extends Object{
    private $_pools;
    private static $_tableInfoPool = null;

    private function __construct()
    {
        echobr('第一次实例化tableinfopool');
    }

    public function getTableInfo($tableName)
    {
        if (array_key_exists('tableName',$this->_pools)) {
            return $this->_pools[$tableName];
        } else {
            return $this->_pools[$tableName] = $this->_createTableInfo();
        }
    }

    private function _createTableInfo()
    {
        $db = App::getDb();
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