<?php


namespace ishop;


class Db
{
    use TSingletone;

    private function __construct()
    {

        $config = require CONF . "/config_db.php";
        
        \R::setup($config["dsn"],$config["userName"], $config["password"]);
        
        if(!\R::testConnection()){
            throw new \Exception("Database not Available",500);
        }
    }
}