<?php


namespace app\controllers;


class CategoryController extends AppController
{

    public function indexAction(){
        function recursCategory($idCat){
            $podCategory = \R::find("category",'parent_id = ?', [$idCat] );
            if($podCategory){
//               TODO
            }
        }
        $alias = $this->route['alias'];
        $idAlias = \R::findOne('category','alias = ?', [$alias] )->id;
        $podCategory = \R::find("category",'parent_id = ?', [$idAlias] );
        debug($podCategory,1);
    }
}