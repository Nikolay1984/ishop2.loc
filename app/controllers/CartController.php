<?php


namespace app\controllers;


use app\models\Cart;
use app\models\User;
use ishop\BreadcrumbsRender;

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


    public function viewAction(){
        $this->setMeta("hockers","escort",'pussy,foxy');
        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs("home","КОРЗИНА");
        $this->set(compact('breadCrumbs'));
    }
    public function checkoutAction(){

        if($_POST){

            if(!isset($_SESSION["user"])){
                if(isset($_POST['user'])){
                    $instModel = new User();
                    $data = $_POST['user'];
                    $instModel->load($data);

                    if(!$instModel->validate($data) || !$instModel->checkUniq()){
                        $_SESSION['formData'] = $data;
                        $instModel->setSessionErrors();
                        redirect();

                    }else{
                        $instModel->attributes['password'] = password_hash($instModel->attributes['password'],
                            PASSWORD_DEFAULT);
                        if($user_id = $instModel->saveInBD("user")){
                            $_SESSION['success'] = "Регистрация прошла успешна!";
                            foreach ($data as $key=>$value){
                                if($key != "password"){
                                    $_SESSION["user"][$key] = $value;
                                }
                            }

                        }else{
                            $_SESSION['errors'] = "Бд временно не доступна";
                            redirect();
                        }

                    }


                }
            }
            $data['id'] = isset($_SESSION["user"]['id']) ? $_SESSION["user"]['id'] : $user_id;
            $data['note'] = isset($_POST['note']) ? $_POST['note'] : "";
            //TODO
            debug($data,1);
        }



        }




}