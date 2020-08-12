<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;

class MainController extends AppController
{
    public function indexAction(){

        $this->setMeta("hockers","escort",'pussy,foxy');
        
        $brands = \R::find("brand","LIMIT 3");
        $popularProducts = \R::find("product","hit > '0' LIMIT 8");


        $this->set(compact('brands','popularProducts'));

    }

    public function testAction(){
        echo "test";
    }
}