<?php


namespace app\controllers;


use Couchbase\Exception;
use ishop\App;
use ishop\BreadcrumbsRender;
use ishop\Pagination;
use mysql_xdevapi\Expression;

class CategoryController extends AppController
{

    public function indexAction(){


        $arrCategoryProducts = [];
        $recursCategory = function ($idCat) use (&$arrCategoryProducts, &$recursCategory){
            $podCategory = \R::find("category",'parent_id = ?', [$idCat] );
            if($podCategory){
                foreach ($podCategory as $category){
                    $recursCategory($category["id"]);
                }
            }else{
                $products = \R::find("product",'category_id = ?', [$idCat] );
                $arrCategoryProducts = array_merge($arrCategoryProducts,$products );
            }
        };


        $alias = $this->route['alias'];
        $category = \R::findOne('category','alias = ?', [$alias] );

        if(!$category){
            throw new \Exception("Категория не найдена",404);
        }

        $idAlias = $category->id;
        $recursCategory($idAlias);

        $breadCrumbs = BreadcrumbsRender::getBreadcrumbs($idAlias,"","view");


        $arrCategoryProducts = Pagination::getCurrentProducts($arrCategoryProducts,App::$app->getProperty("pagination"));
        $htmlPagination = Pagination::getHtmlPagination();

        $this->setMeta("category:{$alias}","escort",'pussy,foxy');
        $this->set(compact('arrCategoryProducts','breadCrumbs','htmlPagination'));

    }
}