<?php


namespace ishop\base;


class View
{


    public $route;
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $prefix;
    public $date = [];
    public $meta = [];

    public function __construct($route, $layout = "", $view = "", $meta)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $view ? : $route["action"];
        $this->model = $route["controller"];
        $this->layout = $layout;
        $this->prefix = $route["prefix"];
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }

    }
    public function render($date){
        $viewPath = APP . "/views/" . $this->prefix . "/" . $this->controller . "/" .$this->view .".php";
        if(is_array($date)){
            extract($date);
        }

        if(file_exists($viewPath)){
            ob_start();
            require "$viewPath";
            $content =  ob_get_clean();

        }else{
            throw new \Exception("view {$viewPath} is not found",500);
        }

        if($this->layout !== false){

            $layoutPath = APP . "/views/layouts/"  . $this->layout .".php";

            if(file_exists($layoutPath)){

                require_once "$layoutPath";
            }else{
                throw new \Exception("layout {$layoutPath} is not found",500);
            }
        }


    }
    public function getMeta(){
     return "<meta name='description' content =  {$this->meta['desc']} >
      <meta name='Keywords' content={$this->meta['keywords']} >
      <title>{$this->meta['title']}</title>";


}

}