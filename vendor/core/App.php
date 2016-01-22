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
        $className = 'controller\\' . ucfirst($this->_components['urlManage']->pathInfo['controller']) . 'Controller';
//        echobr($className);
        $this->_components['controller'] = new $className($this->_components['urlManage']->params);
    }

    private function _startAction()
    {
        $funcName = 'action' . ucfirst($this->_components['urlManage']->pathInfo['action']);
        call_user_func([$this->_components['controller'],$funcName]);
    }

    public function __get($property)
    {
        if(array_key_exists($property,$this->_components)){
            return $this->_components[$property];
        } else {
            return $this->_components[$property] = $this->createObject(ucfirst($property));
        }
    }

    /**
     * 后期可能加入依赖注入
     */
    public function createObject($className)
    {
        $config = Pii::app()->config;
        $classPrefix = $config->getValue($className,'core');
        if($classPrefix){
            echobr($classPrefix . '\\' . $className);
            return call_user_func([$classPrefix . '\\' . $className,'getInstance']);
        }
        else {
            $className = $config->getValue($className,'alias');
            if(!$className){
                throw new PiiException('there is no exist config for this name');
            }
            return call_user_func([$className,'getInstance']);
        }
    }
}