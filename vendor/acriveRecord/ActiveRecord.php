<?php
namespace vendor\activeRecord;

use vendor\core\Object;

class ActiveRecord extends Object
{
    private $_isNew = false;

    public function __construct()
    {

    }

    public function setNew()
    {
        $this->_isNew = true;
    }

    
}