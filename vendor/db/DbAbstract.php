<?php
namespace vendor\db;

use vendor\core\Object;

abstract class DbAbstract extends Object
{
    public function __construct(){

    }

    abstract public function startTransaction();
    abstract public function rollbackTransaction();
    abstract public function commitTransaction();
    abstract public function lock();
    abstract public function unlock();

    //ORM
    abstract public function find();
    abstract public function findByPk();
    abstract public function save();
    abstract public function update();
    abstract public function delete();
}