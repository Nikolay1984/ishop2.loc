<?php


namespace app\widgets\menu;


use ishop\App;
use ishop\Cache;

class Menu
{
    protected $data;
    protected $tree;
    protected $tpl;
    protected $class = 'menu';
    protected $container = "ul";
    protected $menuHtml;
    protected $table = "category";
    protected $cache = 3600;
    protected $cacheKey = "ishop_menu";
    protected $prepend = '';
    protected $attrs = [];

    public function __construct($options = [])
    {
        $this->tpl = __DIR__. "/menu_tpl/menu.php";
        $this->getOptions($options);
        $this->run();

    }

    protected function getOptions($options){
        foreach ($options as $key=>$value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    protected function run(){

        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if(!$this->menuHtml){
            $this->data = App::$app->getProperty("cats");

            if(!$this->data){
                $table = $this->table;
                $this->data = \R::getAssoc("SELECT * FROM $table");

            }
            $this->tree = $this->getTree($this->data);
            $this->menuHtml = $this->getMenuHtml($this->tree);

            if($this->cache){

                $cache->set($this->cacheKey, $this->menuHtml,$this->cache);
            }
        }
        $this->output();

    }

    protected function output(){
        $strAtr = '';
        foreach ($this->attrs as $key=>$value){
            $strAtr .=  "$key='$value'";
        }
        echo $this->prepend;
        echo "<$this->container class = '{$this->class}' $strAtr >";
        echo $this->menuHtml;
        echo "</" . $this->container. ">";

    }

    protected function getMenuHtml($tree,$tab = ""){

        $str = "";

        foreach ($tree as $id=>$category) {
            $str .= $this->catToTemplate($category, $tab, $id);

        }

        return $str;



    }
    protected function getTree($data){
        $tree = [];
        foreach ($data as $id=>&$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;

    }
    protected function catToTemplate($category,$tab,$id){

        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }



}