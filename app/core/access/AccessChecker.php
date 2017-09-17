<?php

namespace app\core\access;

use app\core\http\Request;
use app\core\routing\RouteMatchInterface;

/**
 * AccessChecker is responsible for managing access to modules ,route and the app as a whole
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccessChecker {

    public function checkRequest(Request $request, $account) {

    }

    public function doCheck(RouteMatchInterface $route_match) {
        $route = $route_match->getRouteObject();
        $checks = $route->getOption('_check') ?: [];
    }

}
