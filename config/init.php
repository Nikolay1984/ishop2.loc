<?php

define("DEBUG",1 );
define("ROOT", dirname(__DIR__) );
define("WWW", ROOT.'/public' );
define("APP", ROOT.'/app' );
define("CORE", ROOT.'/vendor/ishop/core' );
define("LIBS", ROOT.'/vendor/ishop/core/libs' );
define("CACHE", ROOT.'/tmp/cache' );
define("CONF", ROOT.'/config' );
define("LAYOUT", 'watch' );
define("PATH",  "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
define("ADMIN",  PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';
require_once LIBS . '/functions.php';
require_once LIBS . '/rb.php';
require CONF."/routers.php";
