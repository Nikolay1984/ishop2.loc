<?php


namespace app\controllers;


use app\models\AppModel;

class MainController extends AppController
{
    public function indexAction(){

        $this->setMeta("hockers","escort",'pussy,foxy');
        $name = "Petja";
        $age = 33;
        $this->set(compact("name","age"));

    }

    public function testAction(){
        echo "test";
    }
}