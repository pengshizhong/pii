<?php
namespace vendor\core;

class Object
{
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
        $funcName = 'get' . ucfirst(substr($property,1));
        if (method_exists($this,$funcName)) {
            return call_user_func([$this,$funcName]);
        }
//        if (property_exists(get_class($this),$property)) {
//            $tmp = $this;
//            var_dump($tmp);
//            return $tmp->$property;
//            小测试
//        }
        else {
            if (false) {
                //行为？
            } else {
                return null;
            }
        }
    }

    public function setAttributes (array $data)
    {

    }
}