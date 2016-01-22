<?php
namespace vendor\db;

use vendor\core\Object;
use vendor\core\Pii;

class ActiveRecord extends Object
{
    private $_isNew;
    private $_attributions=[];
    private $_pk;

    public function __construct($isNew=true)
    {
        $this->_isNew = $isNew;
        $tableInfo = $this->getTableInfo();
        //var_dump($attributions);
        $this->_attributions = $tableInfo;
        $this->_init();
    }

    private function _init()
    {
        foreach ($this->_attributions as &$attribution) {
            $attribution['value'] = $attribution['Default'];
            if ($attribution['Key']=='PRI') {
                $this->_pk = $attribution['Field'];
            }
        }
    }

    public function getTableInfo()
    {
//        $tableInfo = Pii::app()->tableInfoPool;
        echobr('tableName : ' . $this->tableName());
//        $tableInfo->getTableInfo($this->tableName());
        return Pii::app()->tableInfoPool->getTableInfo($this->tableName());
        //return $tableInfo->getTableInfo($this->tableName);
    }

    public function save()
    {
        if($this->_isNew) {
            Pii::app()->db->save($this);
        }
        else{
            Pii::app()->db->update($this);
        }
    }

    public function delete()
    {

    }

    public function getAttributions()
    {   //vardumpbr($this->_attributions);
        //echobr('调用成功？');
        //vardumpbr($this->_attributions);
        return $this->_attributions;
    }

    public function setAttributions($property,$value)
    {

    }

    public function __set($property,$value)
    {
        if(array_key_exists($property,$this->_attributions)){
            $this->_attributions[$property]['value'] = $value;
        }
    }

    public function getPk()
    {
        return $this->_pk;
    }
    public function __get($property)
    {
        if(array_key_exists($property,$this->_attributions)){
            return $this->_attributions[$property];
        }
        return parent::__get($property);
    }
}