<?php

namespace app\core;

use app\core\Request;
use app\core\Response;
use app\core\service\KernelService;

/**
 * Description of kernel
 *
 * @author Tobi
 */
class Kernel {

    protected $services = [];

    public function __construct() {

    }

    public function installService(KernelService $service) {
        $this->services[$service->name] = $service;
    }

    public function uninstallService(KernelService $service) {
        if (!array_key_exists($service->name, $this->services)) {
            echo "{$service->name} is not installed";
            return FALSE;
        }
        $this->services[$service->name] = null;
    }

    public function getInstalledServices() {

    }

    public function startAllServices() {
        foreach ($this->services as $service) {
            $service->start();
        }
    }

    function stopAllServices() {

    }

    public function handle(Request $request) {
        $response = new Response();
        $response->process($request);
        return $response;
    }

}
