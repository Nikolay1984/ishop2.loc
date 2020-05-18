<?php


namespace ishop;


class Registry
{
 use TSingletone;

 public static $properties = [];

 public static function setProperty($key,$value){
     self::$properties[$key] = $value;
 }

 public static function getProperty($key){
     if(isset(self::$properties[$key])){
         return self::$properties[$key];
     }
     return null;
 }

}
