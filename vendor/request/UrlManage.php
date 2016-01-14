<?php
namespace vendor\request;

use vendor\core\Object;

class UrlManage extends Object
{
    private $_requestUrl;
    private $_pathInfo;
    private $_params;

    public function __construct()
    {
        $this->_requestUrl = $_SERVER['REQUEST_URI'];
        $this->parseUrl();
    }

    public function parseUrl()
    {
        $urlArgs = explode('/',$this->_requestUrl);
        //var_dump($urlArgs);
        $this->_pathInfo['controller'] = $urlArgs[1];
        $this->_pathInfo['action']     = $urlArgs[2];
        if(count($urlArgs)>3 && $urlArgs%2==1) {
            for ($i = 3; $i < count($urlArgs) - 2; $i = $i + 2) {
                $this->_params[$urlArgs[$i]] = $urlArgs[$i + 1];
            }
            $this->_params[$urlArgs[$i]] = substr($urlArgs[$i+1],0,strlen($urlArgs[$i+1])-5);
        }
    }

    public function getPathInfo()
    {
        return $this->_pathInfo;
    }

    public function getParams()
    {
        return $this->_params;
    }
}
