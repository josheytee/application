<?php

namespace app\core\service;

class ServiceManager
{

    private static $instances = array();

    private function __construct()
    {

    }

// prevent creating multiple instances due to "private" constructor

    public static function getService($service)
    {
        $service = "\app\core\service\\" . $service;
        if (!array_key_exists($service, self::$instances)) {
            self::$instances[$service] = new $service();
        }
        return self::$instances[$service];
    }

// prevent the instance from being cloned

    private function __clone()
    {

    }

// prevent from being unserialized

}
