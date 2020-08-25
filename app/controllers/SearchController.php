<?php


namespace app\controllers;


use ishop\BreadcrumbsRender;

class SearchController extends AppController
{
    public function indexAction(){


            $query = !empty($_GET['s']) ? trim($_GET['s']) : null;
            if(isset($query)){
                $searchProducts = \R::find("product", "title LIKE ?", ["%{$query}%"]);
            }else{
                $searchProducts = null;
            }
            $breadCrumbs = BreadcrumbsRender::getBreadcrumbs("home",$query,"viewSearch");

            $this->setMeta("res of search","xujli majli",'pussy,foxy');
            $this->set(compact('searchProducts',"query", "breadCrumbs"));

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