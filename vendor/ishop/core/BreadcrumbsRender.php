<?php


namespace ishop;

use app\models\BreadCrumbs;

class BreadcrumbsRender
{
        static public function getBreadcrumbs($id='home',$title='',$view='view'){

            if($id!='home'){
                $breadCrumbs = array_reverse(BreadCrumbs::getBreadCrumbs($id,$title));
            }
            ob_start();
            require VIEWS . "/BreadCrumbs/{$view}.php";
            $htmlBreadCrumbs = ob_get_clean();
            return $htmlBreadCrumbs;
        }
}