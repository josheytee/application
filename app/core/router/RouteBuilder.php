<?php

namespace app\core\router;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use app\core\module\ModuleManager;
use app\core\Context;

/**
 * Description of RouteBuilder
 *
 * @author adapter
 */
class RouteBuilder {

    private $manager;

    public function __construct(ModuleManager $manager) {
        $this->manager = $manager;
    }

    public function build() {
        $user = Context::getContext()->user;
    }

}
