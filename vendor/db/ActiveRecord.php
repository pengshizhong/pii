<?php
namespace vendor\db;

use vendor\core\Object;
use vendor\core\Pii;

class ActiveRecord extends Object
{
    private $_isNew;
    private $_arrtibutions=[];
    private $_pk;

    public function __construct($isNew=true)
    {
        $this->_isNew = $isNew;
        $attributions = $this->getProperties();
        //var_dump($attributions);
        foreach ($attributions as $attribution) {
            $this->_arrtibutions[$attribution['Field']] = null;
        }
        //$this->_pk = $attributions['ex'];
    }

    public function getProperties()
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
            Pii::app()->db->save();
        }
        else{
            Pii::app()->db->update();
        }
    }

    public function delete()
    {

    }

    public function setAttribution($property,$value)
    {

    }

    public function __set($property,$value)
    {
        if(array_key_exists($property,$this->_arrtibutions)){
            $this->_arrtibutions[$property] = $value;
        }
    }

    public function __get($property)
    {
        if(array_key_exists($property,$this->_arrtibutions)){
            return $this->_arrtibutions[$property];
        }
    }
}