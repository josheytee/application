<?php

namespace app\core\component;

use app\core\routing\RouteMatchInterface;

/**
 * Description of ComponentResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DefaultTargetResolver implements ComponentTargetResolverInterface {

    /**
     * @var ComponentManager
     */
    private $componentManager;

    public function __construct(ComponentManager $componentManager) {
        $this->componentManager = $componentManager;
    }

    public function appliesTo(RouteMatchInterface $route_match) {
        return true;
    }

    public function resolveTarget(RouteMatchInterface $route_match) {
        return $this->componentManager->getTargetComponents('front');
    }
}
