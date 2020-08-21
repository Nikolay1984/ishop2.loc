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
            Cart::addProductToCart($product, $modProduct,$quantity);
           redirect();
        }

    }

    public function clearAction(){
        unset($_SESSION['productsInCart']);
        unset($_SESSION['productsInCart.quantity']);
        unset($_SESSION['productsInCart.sum']);
        unset($_SESSION['productsInCart.currency']);
        $this->loadView('cart_modal');
    }

    public function showAction(){
        if(isAJAX()){
            $this->loadView('cart_modal');
        }else{
            $this->setMeta("hockers","escort",'pussy,foxy');
            $this->view = 'cart_modal';
        }
    }
    public function deleteAction(){

        if(isAJAX()){
            if(Cart::deleteProductFromCart()){
                $this->loadView('cart_modal');
            }else{
                return false;
            }
        }else{
            if(Cart::deleteProductFromCart()){
                $this->setMeta("hockers","escort",'pussy,foxy');
                $this->view = 'cart_modal';
            }else{
                throw new \Exception("Ошибка сервера",505);
            }

        }


    }

}