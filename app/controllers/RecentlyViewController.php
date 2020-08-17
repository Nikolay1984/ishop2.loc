<?php


namespace app\controllers;


use app\models\Product;

class RecentlyViewController extends AppController
{
    public function viewAction(){

        $productModelInst = new Product();
        $visitedProducts = $productModelInst->getDataProducts();
        $this->set(compact("visitedProducts"));

    }

}