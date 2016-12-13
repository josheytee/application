<?php

namespace app\core\service;

use app\core\service\KernelServiceInterface;

/**
 * Description of KernelService
 *
 * @author Tobi
 */
class KernelService implements KernelServiceInterface {

    public $running;

    public function __construct() {
        $this->running = FALSE;
    }

    public function start() {
        $this->running = TRUE;
    }

    public function stop() {
        $this->running = FALSE;
    }

    public function install() {

    }

    public function uninstall() {

    }

}
