<?php
namespace vendor\core;

use vendor\db\TableInfoPool;
use vendor\di\Container;
use vendor\request\UrlManage;

class App extends Object{
    private $_components = [];

    private function init() {
        $this->_components['urlManage'] = new UrlManage();
        $this->_components['diContainer'] = new Container();
        $this->_components['appDir'] = dirname(dirname(__DIR__)) . '/';
        $this->_components['config'] = ConfigManger::load();
    }

    public function run()
    {
        try {
            $this->init();
            $this->_createController();
            $this->_startAction();
        }
        catch(PiiException $e){
            echobr($e->getMessage());
        }
    }

    private function _createController()
    {
        //echo 'debug<br>';
        //var_dump(self::$_urlManage->_pathInfo['controller']);
        $className = 'controller\\' . ucfirst($this->_components['urlManage']->_pathInfo['controller']) . 'Controller';
//        echobr($className);
        $this->_components['controller'] = new $className($this->_components['urlManage']->_params);
    }

    private function _startAction()
    {
        $funcName = 'action' . ucfirst($this->_components['urlManage']->_pathInfo['action']);
        call_user_func([$this->_components['controller'],$funcName]);
    }

    public function __get($property)
    {
        if(array_key_exists($property,$this->_components)){
            return $this->_components[$property];
        } else {
            return $this->_components[$property] = call_user_func([ucfirst($property),'getInstance']);
        }
    }

}