<?php



require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';

new ishop\App();

ishop\App::$app::setProperty("bla", 10);
debug(ishop\App::$app::$properties);
