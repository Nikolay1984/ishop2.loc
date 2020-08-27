<?php


namespace app\controllers;


use ishop\App;

class CurrencyController extends AppController
{
        public function changeAction(){

            $val = isset($_GET["curr"]) ? $_GET["curr"]:null;
            if(!empty($val) && isset((App::$app->getProperty("currencies"))[$val])){

                setcookie("currency", $val, time() + 3600*24*7,"/");
                $_SESSION['productsInCart.currency'] = App::$app->getProperty("currencies")[$val];
                redirect();
            }



        }
}