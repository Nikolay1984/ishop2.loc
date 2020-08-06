<?php


namespace ishop;


class ErrorHandler
{
    public function __construct()
    {
        set_exception_handler([$this,"exeptionHandler"]);
    }
    public function exeptionHandler($exep){
        require "public/404.php";
        debug($exep,1);

    }
}