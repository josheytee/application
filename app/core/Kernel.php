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
        $service->install();
    }

    public function uninstallService(KernelService $service) {
        $service->uninstall();
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
