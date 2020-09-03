<?php


namespace ishop;


//use app\controllers\MainController;

class Router
{
    public static $route = [];
    public static $routes = [];


    public static function add($regExp, $arr=[])
    {
        self::$routes[$regExp] = $arr;
    }

    public static function dispatch($url){
       $url =   self::removeQuerySting($url);
        if(self::matcheRouter($url)){
            $controller = "\app\controllers\\". self::$route["prefix"].self::upperCamelCase(self::$route["controller"])."Controller";

            if(class_exists($controller)){
                $instController = new $controller(self::$route);

                $action = self::lowerCamelCase( self::$route["action"]."Action");

                if(method_exists($instController,  $action)){
                    $instController->$action();
                    $instController->getView();
                }else{
                    throw new \Exception("action $controller::$action  не существует",505);
                }
            }else{
                throw new \Exception("контроллер $controller не существует",505);
            }

        }else{
            throw new \Exception("страница не существует",404);
        }
    }

    private static function matcheRouter($url){
        foreach (self::$routes as $pattern=>$arrRoute){
            if (preg_match("#$pattern#i", $url,$matche)){

               foreach ($matche as $key=>$value){

                    if(is_string($key)){
                        $arrRoute[$key]=$value;

                    }


                }

                if(!isset($arrRoute["action"])){
                    $arrRoute["action"]="index";
                }
                if(!isset($arrRoute["prefix"])){
                    $arrRoute["prefix"]="";
                }else{
                    $arrRoute["prefix"].="\\";
                }
                self::$route = $arrRoute;
                return true;
           }
        }
        return false;
    }

    private static function upperCamelCase($str){
        $arrStr=explode("-", $str);
        $resStr='';
        foreach ($arrStr as $value){
            $resStr.=ucfirst($value);
        }
        return $resStr;
    }

    private static function lowerCamelCase($str){
        return lcfirst(self::upperCamelCase($str));
    }
    private static function removeQuerySting($url){
        $arrUrl = explode("&", $url);
        if(stristr($arrUrl[0], "=")){
            return "";
        }
        return rtrim($arrUrl[0],"/");
    }
}