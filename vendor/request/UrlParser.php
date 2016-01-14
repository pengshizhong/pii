<?php
namespace vendor\request;

class UrlParser
{
    private $_requestUrl;

    public function __construct()
    {
        $this->_requestUrl = $_SERVER['REQUEST_URI'];
        
    }
}
