<?php


namespace app\models;


use ishop\App;

class Cart extends AppModel
{
    public static function getProduct($id){

        return \R::findOne("product", "id = ?", [$id]);
    }
    public static function getProductMod($product,$modId){
        if(!$product){return false;}
        if($modId == 0){
            return ["id" =>$modId, "product_id"=>$product->id,"title"=>"", "price" => $product->price];
        }
        return \R::findOne("modification", "id = ? AND product_id = ?", [$modId, $product->id]);
    }
    public static function checkProductAndMod($product,$mod){
        if ($product) {
            if ($mod) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function addProductToCart($product,$mod,$quantity){

        $_SESSION['productsInCart.currency'] = App::$app->getProperty("currency");



        $cartProduct = ['quantity'=> 0, 'price'=>$mod['price'],
                        'img'=>$product->img,'name'=>$product->title, 'modName'=>$mod['title'],'alias' => $product->alias];

        if(!isset($_SESSION['productsInCart'])){
            $_SESSION['productsInCart'] = [];
            $_SESSION['productsInCart.quantity'] = 0;
            $_SESSION['productsInCart.sum'] = 0;
        }
        if(!key_exists($product->id.$mod['title'], $_SESSION['productsInCart'])){
            $_SESSION['productsInCart'][$product->id.$mod['title']] = $cartProduct;
        }

        $_SESSION['productsInCart'][$product->id.$mod['title']]['quantity']+=$quantity;
        $_SESSION['productsInCart.quantity'] += $quantity;
        $_SESSION['productsInCart.sum'] += $quantity * $mod['price'];

    }
}