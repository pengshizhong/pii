<?php
namespace vendor\db;

use vendor\core\App;
use vendor\core\Object;
use vendor\core\Pii;

class ActiveRecord extends Object
{
    private $_isNew;

    public function __construct($isNew=true)
    {
        $this->_isNew = $isNew;
        $this->getProperties();
    }

    public function getProperties()
    {

        $tableInfo = Pii::app()->tableInfoPool;
        var_dump($tableInfo);
        //return $tableInfo->getTableInfo($this->tableName);
    }

    public function save()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}