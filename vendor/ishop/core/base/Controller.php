<?php


namespace ishop\base;


abstract class Controller
{
    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $layout;
    public $date = [];
    public $meta = ["title"=>'',"desc"=>'',"keywords"=>''];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $route["action"];
        $this->model = $route["controller"];
        $this->prefix = $route["prefix"];

    }
    public function set($dataArr){
        $this->date = $dataArr;
    }
    public function setMeta($title="",$desc="",$keywords=""){
        $this->meta["title"] = $title;
        $this->meta["desc"] = $desc;
        $this->meta["keywords"] = $keywords;
    }
    public function getView(){
        $view = new View($this->route, $this->layout, $this->view, $this->meta);
        $view->render($this->date);
    }
}