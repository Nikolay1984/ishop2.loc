<?php


namespace app\controllers;


use ishop\App;
use ishop\BreadcrumbsRender;
use ishop\Pagination;

class SearchController extends AppController
{
    public function indexAction(){


            $query = !empty($_GET['s']) ? trim($_GET['s']) : null;
            if(isset($query)){
                $searchProducts = \R::find("product", "title LIKE ?", ["%{$query}%"]);
            }else{
                $searchProducts = [];
            }
            $breadCrumbs = BreadcrumbsRender::getBreadcrumbs("home",$query,"viewSearch");

            $searchProducts = Pagination::getCurrentProducts($searchProducts,App::$app->getProperty("pagination"));
            $htmlPagination = Pagination::getHtmlPagination();

            $this->setMeta("res of search","xujli majli",'pussy,foxy');
            $this->set(compact('searchProducts',"query", "breadCrumbs", 'htmlPagination'));

    }


    public function typeaheadAction(){
     if(isAJAX()){
         $query = !empty($_GET['query']) ? trim($_GET['query']) : null;
         if(isset($query)){
             $res = \R::getAll("SELECT id, title FROM product WHERE title LIKE ? LIMIT 10", ["%{$query}%"]);
             echo json_encode($res);
         }
     }
     die();
    }
}