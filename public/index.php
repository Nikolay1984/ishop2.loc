<?php



require_once dirname(__DIR__) . '/config/init.php';


new ishop\App();

$cache = \ishop\Cache::instance();
$str = "bla cache";

$cache->set("testCache", $str);
$data = $cache->get("testCache");
var_dump($data);






