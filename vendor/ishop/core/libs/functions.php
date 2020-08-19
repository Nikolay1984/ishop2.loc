<?php
function debug($arr, $die = false){
    echo "<pre>" . print_r($arr,true) . "</pre>";
    if($die){
        die("смертельный дебугер!");
    }
}

function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:PATH;
    }
    header("Location:$redirect");
    exit();
}

function isAJAX(){
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
       return true;
    }
    return false;

}