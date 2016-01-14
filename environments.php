<?php
class LoadBaseEnvironment
{
    public static $configs = ['exception' => 'vendor/core/PiiException.php'];

    public static function load()
    {
        $dirPrefix = __DIR__;
        foreach (self::$configs as $fileName) {
            $filePath = $dirPrefix . '/' . $fileName;
            if (file_exists($filePath)) {
                require_once $filePath;
            } else {
                echo "core component $filePath error";
                exit;
            }
        }
    }
}