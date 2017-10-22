<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ntc\administrator\component;

use app\core\component\ComponentManager;
use app\core\component\ComponentTargetResolverInterface;
use app\core\routing\AdminContext;
use app\core\routing\RouteMatchInterface;

/**
 * Description of AdminTargetResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminTargetResolver implements ComponentTargetResolverInterface
{

    /**
     * @var AdminContext
     */
    private $context;

    /**
     * @var ComponentManager
     */
    private $componentManager;

    public function __construct(AdminContext $context, ComponentManager $componentManager)
    {
        $this->context = $context;
        $this->componentManager = $componentManager;
    }

    public function appliesTo(RouteMatchInterface $route_match)
    {
        return $this->context->isAdminRoute($route_match->getRouteObject());
    }

    public function resolveTarget(RouteMatchInterface $route_match)
    {
        return $this->componentManager->getTargetComponents('admin');
    }

}
