<?php


namespace app\widgets\filter;


use ishop\Cache;

class Filter
{
    public function __construct()
    {
        $this->tpl = __DIR__ . "/filter_tpl.php";
        $this->run();
    }

    public function run(){
        $cache = Cache::instance();
        $this->groups = $cache->get("filter_group");
        if(!$this->groups){
            $this->groups = $this->getGroups();
            $cache->set("filter_group", $this->groups,1);
        }
        $this->attrs = $cache->get("filter_attrs");
        if(!$this->attrs){
            $this->attrs = $this->getAttrs();
            $cache->set("filter_attrs", $this->attrs,1);
        }
//        debug($this->attrs,1);
        echo $this->getHtml();

    }

    public function getGroups(){
        return \R::getAssoc('SELECT id, title FROM attribute_group');
    }
    public function getAttrs(){
         $attrs = [];
         $temp  = \R::getAssoc('SELECT * FROM attribute_value');
         foreach ($temp as $key=>$value){
             $attrs[$value['attr_group_id']][$key] = $value['value'];
         }
         return $attrs;



    }
    public function getHtml(){
        ob_start();
        require $this->tpl;
        return ob_get_clean();


    }


}