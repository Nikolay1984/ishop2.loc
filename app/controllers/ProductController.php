<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Product;
use ishop\BreadcrumbsRender;

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

        $gallery = \R::getAll("SELECT * FROM gallery WHERE product_id = ?" , [$product["id"]]);
        if(!$gallery){
            $gallery[]=["id" => 1,
            "product_id" => $product["id"],
            "img" => $product["img"]];
        }


        $productModelInst = new Product();
        $visitedProducts = $productModelInst->getDataProducts(3);
        $productModelInst->setProductId($product["id"]);

        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs($product["category_id"],$product["title"],"view");

//        $breadCrumbs = array_reverse(BreadCrumbs::getBreadCrumbs($product["category_id"], $product["title"]));
        
        $productModifications = \R::findAll("modification", "product_id = ?", [$product['id']]);




        $this->set(compact('product', "related", "gallery","visitedProducts","breadCrumbs","productModifications"));

    }


}