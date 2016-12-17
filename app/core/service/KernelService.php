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
    public $service_list = [];
    private static $instance;

    public function __construct() {
        $this->name = get_class($this);
    }

    private static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public static function start() {
        if (!self::$running) {
            self::$running = TRUE;
            return self::getInstance();
        }
    }

    public function stop() {
        $this->running = FALSE;
    }

    public static function subscribe($object = null) {
        return self::start();
    }

    public function unsubscribe() {
        $this->stop();
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
