<?php


namespace ishop;


class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_exception_handler([$this,"exeptionHandler"]);

    }
    public function exeptionHandler($exep){
//        debug($exep,1);
        $this->logErrors($exep->getMessage(), $exep->getFile(), $exep->getLine());
     $this->displayErrors($exep->getMessage(), $exep->getFile(), $exep->getLine(),$exep->getCode());
    }
    public function logErrors($message = '', $file = '', $line = ''){
        $message = "[".date('Y-m-d H:i:s')."] : " . "Сообщение: ". $message . "; Файл: " . $file . "; Строка: "
            . $line ."!\n=============================\n";
        error_log($message, 3, ROOT."/tmp/errorLog.txt");
    }

    public function displayErrors($message = '', $file = '', $line = '',$code = 404, $number = 0){

        http_response_code($code);

        if(!DEBUG && $code == 404){
            include WWW . "/errors/404.php";
            die();
        }
        if(DEBUG){

            include WWW . "/errors/dev.php";
        }else{
            include WWW . "/errors/prod.php";
        }



    }

}