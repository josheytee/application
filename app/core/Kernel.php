<?php

namespace app\core;

use app\core\Request;
use app\core\Response;

/**
 * Description of kernel
 *
 * @author Tobi
 */
class Kernel {

    public function __construct() {

    }

    public function handle(Request $request) {
        $response = new Response();
        $response->process($request);
        return $response;
    }

}
