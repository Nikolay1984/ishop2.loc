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

            $this->loadView('cart_modal');
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

    public function showAction(){
        if(isAJAX()){
            $this->loadView('cart_modal');
        }
        die();
    }
    public function deleteAction(){
        $idDeleteProduct = $_GET["deleteFromCart"];
        $deleteProduct = $_SESSION['productsInCart'][$idDeleteProduct];
        $priceDeleteProduct = $deleteProduct['price'];
        $quantityDeleteProduct = $deleteProduct['quantity'];
        $deleteSum = $priceDeleteProduct*$quantityDeleteProduct;
        $_SESSION['productsInCart.quantity'] -= $quantityDeleteProduct;
        $_SESSION['productsInCart.sum'] -= $deleteSum;
        unset($_SESSION['productsInCart'][$idDeleteProduct]);
        $this->loadView('cart_modal');

    }

}