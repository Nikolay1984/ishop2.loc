<?php


namespace ishop;


class Pagination
{
    static private $viewCountProducts;
    static private $uri;
    static private $allProducts = null;
    static private $countPages;
    static private $currentPage;


    static  private  function correctCurrentNumberPage($currentNumberPage){
        if($currentNumberPage < 1){
            return 1;
        }
        if($currentNumberPage > self::$countPages){
            return self::$countPages;
        }
        return $currentNumberPage;

    }
    static private function startPagination($allProducts,$viewCountProducts){
        self::$viewCountProducts = $viewCountProducts;
        self::$allProducts = $allProducts;
        self::$countPages = ceil(count($allProducts)/$viewCountProducts);
        self::$uri = self::getUri();
        self::$currentPage = self::correctCurrentNumberPage(self::getCurrentPage());
    }
    static private function getUri(){
        $url = $_SERVER["REQUEST_URI"];
        $url  = explode("?", $url);
        $uri = $url[0] . "?";
        $arrParam  = @explode("&", $url[1]);

        foreach ($arrParam as $param){
            if(!preg_match("#page=#", $param) && $param != "" ){
                $uri = $uri . $param . "&amp;";
            }
        }
//        debug($uri,1);

        return $uri;
    }
    static private function getCurrentPage(){
        if(!isset($_GET['page'])){
            return 1;
        }
        return $_GET['page'];

    }

    static public function getCurrentProducts($allProducts,$viewCountProducts = 8){

        if(!$allProducts){
            return "";
        }
        self::startPagination($allProducts,$viewCountProducts);

        $arrStart = self::$viewCountProducts * self::$currentPage - self::$viewCountProducts;
        return array_slice($allProducts,$arrStart,self::$viewCountProducts);
    }


    static public function getHtmlPagination(){
//        debug(self::$allProducts);

        if(!isset(self::$allProducts)){
            return "";
        }

        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left= null;
        $page2right= null;
        $page1right= null;
        $currentPage= self::$currentPage;
        $uri = self::$uri;
        $countPages = self::$countPages;


        if($currentPage > 1){
            $back = "<li><a class='nav-link' href='{$uri}page=" .($currentPage - 1)."'>&lt;</a></li>";
        }

        if($currentPage < $countPages){
            $forward = "<li><a class='nav-link' href='{$uri}page=" .($currentPage + 1)."'>&gt;</a></li>";
        }

        if($currentPage > 3){
            $startpage = "<li><a class='nav-link' href='{$uri}page=1'>&laquo;</a></li>";
        }

        if($currentPage < ($countPages - 2)){
            $endpage = "<li><a class='nav-link' href='{$uri}page={$countPages}'>&raquo;</a></li>";
        }

        if($currentPage - 2 > 0){
            $page2left = "<li><a class='nav-link' href='{$uri}page=" .
                ($currentPage - 2)."'>". ($currentPage - 2) . "</a></li>";
        }

        if($currentPage - 1 > 0){
            $page1left = "<li><a class='nav-link' href='{$uri}page=" .
                ($currentPage - 1)."'>". ($currentPage - 1) . "</a></li>";
        }

        if($currentPage + 1 <= $countPages){
            $page1right = "<li><a class='nav-link' href='{$uri}page=" .
                ($currentPage + 1)."'>". ($currentPage + 1) . "</a></li>";
        }

        if($currentPage + 2 <= $countPages){
            $page2right = "<li><a class='nav-link' href='{$uri}page=" .
                ($currentPage + 2)."'>". ($currentPage + 2) . "</a></li>";
        }

        return '<ul class = "pagination">' .$startpage.$back.$page2left.$page1left."<li class='active'><a class='nav-link'>$currentPage</a><li>"
             . $page1right.$page2right.$forward.$endpage.'</ul>';

    }
    static public function getCountPages(){
        return self::$countPages;
    }

}