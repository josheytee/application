<?php

namespace app\core\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\dependencyInjection\ContainerInjectionInterface;
use app\core\Context;

/**
 * Description of Controller
 *
 * @author adapter
 */
abstract class ControllerBase implements ContainerInjectionInterface {

    public static function inject(ContainerInterface $container) {
        return new static();
    }

    public function getDoctrine() {
        return Context::getDoctrine();
    }

}
