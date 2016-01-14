<?php
namespace vendor\web;

use vendor\core\Object;

class Controller extends Object
{
    protected $_params;

    public function __construct($params)
    {
        $this->_params = $params;
    }

}