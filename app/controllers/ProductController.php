<?php


namespace app\controllers;


use app\models\Product;

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


//        function getVisitedProducts($product){
//            if (!isset($_COOKIE["visitedProducts"])){
//                $visitedProducts = [];
//            }else{
//                $visitedProducts = unserialize($_COOKIE["visitedProducts"]);
//            }
//
//            if (!in_array($product["id"], $visitedProducts)){
//                if(count($visitedProducts) == 6){
//                    array_shift($visitedProducts);
//                }
//                $visitedProducts[]=$product["id"];
//            }
//
//            $dataProducts = \R::findLike( 'product', ['id' => $visitedProducts] );
//            $resProducts = [];
//            for($i = 0 ; $i < count($visitedProducts); $i++){
//                $id = $visitedProducts[$i];
//                foreach ($dataProducts as $val){
//                    if($val['id'] == $id){
//                        $resProducts[]=$val;
//                    }
//                }
//            }
//
//            setcookie("visitedProducts", serialize($visitedProducts),time()*3600*24, "/" );
//            array_pop($resProducts);
//            return $resProducts;
//
//        }

//        $visitedProducts = getVisitedProducts($product);

        $productModelInst = new Product();
        $visitedProducts = $productModelInst->getDataProducts();
        $visitedProducts = $productModelInst->rangeProducts($visitedProducts,3);
        $productModelInst->setProductId($product["id"]);

        $this->set(compact('product', "related", "gallery","visitedProducts"));

    }


}