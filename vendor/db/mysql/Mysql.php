<?php
namespace vendor\db\mysql;

use vendor\db\DbAbstract;

abstract class Mysql extends DbAbstract{
    private $_connection;

    public function __construct($config)
    {
        $this->connect();
    }

    private function query(){

    }

    private function connect()
    {

    }
}