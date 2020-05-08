<?php
const BLA = 5;
define("DEBUG",1 );
define("ROOT", dirname(__DIR__) );
define("WWW", ROOT.'/pubic' );
define("APP", ROOT.'/app' );
define("CORE", ROOT.'/vendor/ishop/core' );
define("LIBS", ROOT.'/vendor/ishop/core/libs' );
define("CACHE", ROOT.'/tmp/cache' );
define("CONF", ROOT.'/config' );
define("LAYOUT", 'default' );
define("PATH",  "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
define("ADMIN",  PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';
