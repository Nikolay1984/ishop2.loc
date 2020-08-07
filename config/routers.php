<?php

use \ishop\Router;


Router::add('^admin$',['controller'=>'MainController','action'=>'index','prefix'=>'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$',['prefix'=>'admin']);

Router::add('^$',['controller'=>'MainController','action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');