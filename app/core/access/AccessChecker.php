<?php

namespace app\core\access;

use app\core\routing\RouteMatchInterface;
use app\core\http\Request;

/**
 * AccessChecker is responsible for managing access to modules ,route and the app as a whole
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccessChecker {

    public function checkRequest(RouteMatchInterface $route_match, Request $request) {

    }

}
