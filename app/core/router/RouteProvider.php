<?php

namespace app\core\router;

use app\core\Context;

/**
 * Description of RouteProvider
 *
 * @author adapter
 */
class RouteProvider {

    public function __construct() {

    }

    public function getUserRoute($user_id) {
        $user = Context::getContext()->user->id_user;
        $manager = Context::getContext()->manager;
        $user_routes = $manager->getRepository("model\Router")->findOneBy(['user']);
    }

}
