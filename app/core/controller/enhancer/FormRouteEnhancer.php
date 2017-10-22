<?php

namespace app\core\controller\enhancer;

use app\core\routing\enhancer\RouteEnhancerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

/**
 * Enhancer to add a wrapping controller for _form routes.
 */
class FormRouteEnhancer implements RouteEnhancerInterface
{

    /**
     * {@inheritdoc}
     */
    public function applies(Route $route)
    {
        return $route->hasDefault('_form') && !$route->hasDefault('_controller');
    }

    /**
     * {@inheritdoc}
     */
    public function enhance(array $defaults, Request $request)
    {
        $action = 'add';
        if (isset($defaults['_model']) && strpos($defaults['_model'], '.') !== FALSE) {
            list($entity, $action) = explode('.', $defaults['_model']);
            $defaults['_model'] = $entity;
        } elseif (isset($defaults['_model']) && strpos($defaults['_model'], '.') == FALSE) {
            $action = 'create';
        }
        $defaults['_key'] ?? $defaults['_key'] = 'id';
        $defaults['_controller'] = $defaults['_form'] . '::' . $action;
//        dump($defaults);
        unset($defaults['_form']);
        return $defaults;
    }

}
