<?php


namespace app\controllers\admin;


use app\models\User;

class MainController extends AppController
{
    public function indexAction(){
        $countNewOrders = \R::count('order',"status='1'");
        $countProducts = \R::count('product');
        $countUsers = \R::count('user');
        $countCategories= \R::count('category');
        $this->setMeta("Admin-Panel");
        $this->set(compact("countNewOrders","countProducts", "countUsers", "countCategories"));


    }

}