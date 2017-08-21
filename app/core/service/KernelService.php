<?php

namespace app\core\service;

use app\core\service\KernelServiceInterface;

/**
 * Description of KernelService
 *
 * @author Tobi
 */
class KernelService implements KernelServiceInterface {

    public static $running;
    public $name;
    public $log;
    public static $service_list = [];
    public static $instances = [];

    public function __construct() {
        $this->name = get_called_class();
    }

    public static function getService($service) {
        $service = "\app\core\service\\" . $service;
        if (!array_key_exists($service, self::$instances)) {
            self::$instances[$service] = new $service();
        }
        return self::$instances[$service];
    }

    public static function start() {
//        if (!self::$running) {
//            self::$running = TRUE;
        return self::getInstance();
//        }
    }

    public function stop() {
        $this->running = FALSE;
    }

    public function log($status = null) {
        if ($status) {
            return $this->log[date("Y-M-d H:i:s")] = $status;
        }
        foreach ($this->log as $key => $value) {
            echo "<br/>$key --- $value";
        }
    }

}
