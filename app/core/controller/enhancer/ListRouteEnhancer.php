<?php

namespace app\core\controller\enhancer;

use app\core\routing\enhancer\RouteEnhancerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

/**
 * Enhancer to add a wrapping controller for _list routes.
 */
class ListRouteEnhancer implements RouteEnhancerInterface
{

    /**
     * {@inheritdoc}
     */
    public function applies(Route $route)
    {
        return $route->hasDefault('_list') && !$route->hasDefault('_controller');
    }

    /**
     * {@inheritdoc}
     */
    public function enhance(array $defaults, Request $request)
    {
        $defaults['_controller'] = $defaults['_list'] . '::listing';
        return $defaults;
    }

}
