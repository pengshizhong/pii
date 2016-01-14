<?php
namespace controller;

use vendor\web\Controller;

class TestController extends Controller
{
    public function actionAction(){
        echo 'now,you are access the action in test controller<br>';
        echo 'the params are:<br>';
        foreach ($this->_params as $key => $value) {
            echo 'key:'.$key.'   value:'.$value . "<br>";
        }
    }
}
