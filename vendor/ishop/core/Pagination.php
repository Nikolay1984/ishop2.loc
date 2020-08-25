<?php


namespace ishop;


class Pagination
{
    static public $countProducts;
    static public $uri = "contoroller";
    static public $allProducts;
    static public $countPages;
    

    static public function getCurrentProducts($allProducts,$countProducts = 8){
        self::$countProducts = $countProducts;
        self::$allProducts = $allProducts;
        $countPages = ceil(count($allProducts)/$countProducts); 
        
        if(!isset($_COOKIE['posPagination'])){
            setcookie('posPagination','1',time()+3600);
            $_COOKIE['posPagination'] = '1';
        }

        $arrStart = self::$countProducts * (int)$_COOKIE['posPagination'] - self::$countProducts;
        return array_slice($allProducts,$arrStart,self::$countProducts);

    }


    static public function getHtmlPagination(){
        $back = null;
        $forward = null;
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left= null;
        $page2right= null;
        $page1right= null;
        $currentPage= $_COOKIE['posPagination'];
        $uri = self::$uri;
        $countPages = self::$countPages;
        
        if($currentPage > 1){
            $back = "<li><a class='nav-link' href='{$uri}page=" .($currentPage - 1)."'>&lt;</a></li>";
        }

        if($currentPage < $countPages){
            $forward = "<li><a class='nav-link' href='{$uri}page=" .($currentPage + 1)."'>&lt;</a></li>";
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

        return '<ul class = "pagination">' .$startpage.$back.$page2left.$page1left.'<li class="active"><li>'.$currentPage
            . '<a/></li>' . $page1right.$page2right.$forward.$endpage.'</ul>';

    }


}