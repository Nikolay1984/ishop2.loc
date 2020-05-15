<?php


namespace ishop;


class App
{
    public function __construct(){
        $query = trim($_SERVER['QUERY_STRING'], "/");
        session_start();
       var_dump($query);
    }
}
