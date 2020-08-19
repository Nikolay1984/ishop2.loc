<?php


namespace app\controllers;


use app\models\Cart;

class CartController extends AppController
{
    public function addAction(){

        if(isAJAX()) {
            $data = $_GET["mod"];
            extract($data);
            $id = (int)$id;
            $quantity = (int)$quantity;
            $modId = (int)$mod;

            $product = Cart::getProduct($id);
            $modProduct = Cart::getProductMod($product, $modId);
            if(!Cart::checkProductAndMod($product, $modProduct)){
                return false;
            }
            Cart::addProductToCart($product, $modProduct,$quantity);
            echo "OK";
            die();
        }else {
            $id = $_GET["id"];
            $quantity = 1;
            $modId = 0;

            $product = Cart::getProduct($id);
            $modProduct = Cart::getProductMod($product, $modId);

            if(!Cart::checkProductAndMod($product, $modProduct)){
                echo "Ошибка get запроса";
                die();
            }
            echo "OKKKKKKK";
            die();
        }

    }

    public function clearAction(){
        $_SESSION = [];
        unset($_COOKIE[session_name()]);
        session_destroy();
        echo "true";
        die();
    }

}