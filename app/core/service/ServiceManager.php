<?php

namespace app\core\service;

class ServiceManager {

    private static $instances = array();

    public static function getService($service) {
        $service = "\app\core\service\\" . $service;
        if (!array_key_exists($service, self::$instances)) {
            self::$instances[$service] = new $service();
        }
        return self::$instances[$service];
    }

// prevent creating multiple instances due to "private" constructor
    private function __construct() {

    }

// prevent the instance from being cloned
    private function __clone() {

    }

// prevent from being unserialized
    private function __wakeup() {

    }

}
