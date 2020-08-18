<?php


namespace app\models;


class Product extends AppModel
{
    public function setProductId($id){
        $visitedProducts = $this->getAllProductsId();
        if (!$visitedProducts){
            $visitedProducts = [$id];
            setcookie("visitedProducts", serialize($visitedProducts),time() + 3600*24, "/" );

        }else{
            if(!in_array($id, $visitedProducts)){
                $visitedProducts[] = $id;
                setcookie("visitedProducts", serialize($visitedProducts),time()+3600*24, "/" );
            }
        }
    }

    public function getAllProductsId(){
        if (isset($_COOKIE["visitedProducts"])){
            $visitedProducts = unserialize($_COOKIE["visitedProducts"]);
            return $visitedProducts;
        }else{
            return false;
        }
    }

    public function getDataProducts($tail = 0){
        $visitedProducts = $this->getAllProductsId();


        if ($visitedProducts){

            if(  $tail < count($visitedProducts) && $tail != 0 ){
                $visitedProducts = $this->rangeProducts($visitedProducts, $tail);
            }

            $dataProducts = \R::findLike( 'product', ['id' => $visitedProducts] );
            $resProducts = [];
            for($i = 0 ; $i < count($visitedProducts); $i++){
                $id = $visitedProducts[$i];
                foreach ($dataProducts as $val){
                    if($val['id'] == $id){
                        $resProducts[]=$val;
                    }
                }
            }
            return $resProducts;
        }else{
            return false;
        }
    }

    public function rangeProducts($productsArr, $tail ){
        if($productsArr){
            return array_slice($productsArr, -$tail);
        }else{
            return false;
        }
    }

}