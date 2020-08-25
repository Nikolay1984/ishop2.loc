<?php


namespace app\models;


use ishop\App;

class BreadCrumbs
{

    public static $arrRes = [];
    public static function getBreadCrumbs($id,$title=""){
        if(!self::$arrRes){

            self::$arrRes[] = ["title"=>$title];
        }

        $category = App::$app->getProperty("cats");
        $upProduct = $category[$id];
        self::$arrRes[] = ['title'=>$upProduct['title'],'alias'=>$upProduct['alias']];

        $parentId = $upProduct['parent_id'];
        if($parentId){
            self::getBreadCrumbs($parentId);
        }
        return self::$arrRes;

    }


}