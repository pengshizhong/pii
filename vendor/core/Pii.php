<?php
namespace vendor\core;
class Pii{
    private static $_app = null;

    public static function app()
    {
        return self::$_app;
    }

    public static function start()
    {
        self::$_app = new App();
        self::$_app->run();
    }
}