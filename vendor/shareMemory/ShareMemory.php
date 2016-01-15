<?php
namespace vendor\shareMemory;
use vendor\core\Object;
use vendor\core\PiiExcepiton;

class ShareMemory extends Object{
    private  static $_shmid = [];

    private function __construct($config)
    {

    }

    public static function getInstance($config)
    {
        $id = md5($config);
        if(array_key_exists($id,self::$_shmid)){
            return self::$_shmid;
        }
        else {
            $shmid = self::open($config);
            self::$_shmid[$id] = $shmid;
            return $shmid;
        }
    }

    /**
     * @param config
     * $systemId = 864;
     * $mode = "c"; // Access mode
     * $permissions = 0755; // Permissions for the shared memory segment
     * $size = 1024; // Size, in bytes, of the segment
     * $shmid = shmop_open($systemid, $mode, $permissions, $size);
     */
    private function open($config)
    {
        $shmid = shmop_open($config['systemId'],$config['mode'],$config['permissions'],$config['size']);
        if ($shmid) {
            return $shmid;
        }
        else {
            throw new PiiExcepiton('apply for share memory failed');
        }
    }

    public function test()
    {

    }

}