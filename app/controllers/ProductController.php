<?php


namespace app\controllers;


class ProductController extends AppController
{

    public function viewAction(){
        $alias = $this->route['alias'];
        $product = \R::findOne("product","alias=? and status='1'",[$alias]);
        if(!isset($product)){
            throw new \Exception("Page not found",404);
        }
        $this->setMeta($product->title,$product->description,$product->keywords);
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE 
related_product.product_id = ? ",[$product["id"]]);




        $this->set(compact('product', "related"));

    }


}