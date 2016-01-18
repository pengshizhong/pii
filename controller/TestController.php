<?php
namespace controller;

use vendor\core\PiiException;
use model\Test;
use vendor\web\Controller;

class TestController extends Controller
{
    public function actionAction(){
        echo 'now,you are access the action in test controller<br>';
        echo 'the params are:<br>';
        foreach ($this->_params as $key => $value) {
            echo 'key:'.$key.'   value:'.$value . "<br>";
        }
        try {
            throw new PiiException;
        }
        catch (PiiException $e) {
            echo "捕获到异常" . get_class($e) . '<br>';
        }
        $model = new Test();
        //var_dump($model);
    }
}
