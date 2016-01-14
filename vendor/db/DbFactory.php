<?php
namespace vendor\db;

use vendor\core\Object;

class DbFactory extends Object
{
    private $_instance = [];

    public function getInstance($config)
    {
        $idKey = md5($config);
        if (array_key_exists($idKey,$this->_instance)) {
            return $this->_instance[$idKey];
        } else {
            $this->_instance[$idKey] = $this->createInstance($config);
        }
    }

    /**
     * @param config = [
     *      'dbType'    => 'mysql',
     *      'localhost' => 'localhost',
     *      'user'      => 'root',
     *      'password'  => '',
     *       ]
     */
    public function createInstance($config)
    {
        $className = '\vendor\db\\' . $config['dbType'] . '\\' . ucfirst($config['dbType']) . '.php';
        return new $className($config);
    }

}