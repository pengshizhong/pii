<?php
namespace vendor\db;

abstract class QueryBuilder
{
    private $_sql = '';

    public function select($filed = '*')
    {
        $tmp = $this->_sql . ' SELECT ';
        if (is_array($filed)) {
            $count = count($filed);
            for ($i=0;$i<$count;$i++) {
                $tmp .= $filed[$i];
                if($i!=$count-1){
                    $tmp .= ',';
                }
            }
        } else {
            $tmp .= $filed;
        }
        $this->_sql = $tmp;
        return $this;
    }

    public function from($tableName)
    {
        $this->_sql .= ' FROM ' . $tableName;
        return $this;
    }

    public function where($conditions)
    {
        $this->_sql .= ' WHERE ';
        if(is_array($conditions)){
            foreach ($conditions as $condition) {
                $this->_sql .= $condition . ' AND';
            }
            $this->_sql .= ' 1=1';
        }
        return $this;
    }

    public function join($joinTable,$joinType='')
    {
        $this->_sql .= " $joinType JOIN $joinTable";
        return $this;
    }

    public function getSql()
    {
        return $this->_sql;
    }

    public function insert(ActiveRecord $ar)
    {
        $dirtyData  = $ar->attributions;
        $this->_sql = "INSERT INTO $ar->tableName() SET ";
        foreach ($dirtyData as $key => $value) {
            $this->_sql .= "$key=$value ";
        }
        return $this;
    }

    public function update(ActiveRecord $ar)
    {
        $dirtyData = $ar->attributions;
        $this->_sql = "UPDATE $ar->tableName() SET ";
        foreach ($dirtyData as $key=>$value) {
            $this->_sql .= "$key=$value ";
        }
        $this->_sql .= " WHERE $ar->pk=$ar->attribution[$ar->pk]";
        return $this;
    }

    public function delete(ActiveRecord $ar)
    {
        $pk = $ar->attributions[$ar->pk];
        $this->_sql = "DELETE FROM $ar->tableName() WHERE $ar->pk=$pk";
        return $this;
    }
}