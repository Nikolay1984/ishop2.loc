<?php


namespace app\controllers;


use ishop\App;

class CurrencyController extends AppController
{
        public function changeAction(){
        //TODO
//            $val = isset($_GET["curr"]) ? $_GET["curr"]:null;
//            if(!empty($val) && isset((App::$app->getProperty("currencies"))[$val])){
//                setcookie("currency", $val, time() + 3600*24*7,"/");
//                redirect();
//            }

            if(!isset($_COOKIE["currPrev"])){
                setcookie("currPrev", key(App::$app->getProperty("currencies")), time() + 3600*24*7,"/");
                setcookie("currency", $_GET["curr"] , time() + 3600*24*7,"/");
            }else{
                setcookie("currPrev",$_COOKIE["currency"] , time() + 3600*24*7,"/");
                setcookie("currency",$_GET["curr"] , time() + 3600*24*7,"/");
            }
            redirect();

        }
}