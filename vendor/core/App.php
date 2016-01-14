<?php
namespace vendor\core;

use vendor\di\Container;
use vendor\request\UrlManage;

class App extends Object{
    private static $_urlManage;
    private static $_diContainer;
    private static $_controller;

    private static function _beforeRun()
    {
        self::$_urlManage = new UrlManage();
        self::$_diContainer = new Container();
    }

    public static function run()
    {
        self::_beforeRun();
        self::_createController();
        self::_startAction();
    }

    private static function _createController()
    {
        //echo 'debug<br>';
        //var_dump(self::$_urlManage->_pathInfo['controller']);
        $className = 'controller\\' . ucfirst(self::$_urlManage->_pathInfo['controller']) . 'Controller';
        self::$_controller = new $className(self::$_urlManage->_params);
    }

    private static function _startAction()
    {
        $funcName = 'action' . ucfirst(self::$_urlManage->_pathInfo['action']);
        call_user_func([self::$_controller,$funcName]);
    }
}