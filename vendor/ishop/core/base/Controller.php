<?php


namespace ishop\base;


abstract class Controller
{
    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $date =[];
    public $meta =[];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route["controller"];
        $this->view = $route["action"];
        $this->model = $route["controller"];
        $this->prefix = $route["prefix"];

    }
}