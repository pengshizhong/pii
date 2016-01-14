<?php
namespace vendor\core;

class Object
{
    public function __construct()
    {

    }

    public function __set($property,$value)
    {
        if (property_exists(get_class($this),$property)) {
            //存在,且可以访问
            $this->$property = $value;
        } else{
            if (false) {
                //行为？
            } else {
                throw new PiiExcepiton('there is not property in this class',110);
            }
        }
    }

    public function __get($property)
    {
        if (property_exists(get_class($this),$property)) {
            return $this->$property;
        } else{
            if (false) {
                //行为？
            } else {
                throw new PiiExcepiton('there is not property in this class',110);
            }
        }
    }
}