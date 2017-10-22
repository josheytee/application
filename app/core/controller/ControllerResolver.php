<?php

namespace app\core\controller;

use app\core\dependencyInjection\ClassResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;

/**
 * Description of ControllerResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ControllerResolver extends BaseControllerResolver
{

    protected $classResolver;

    public function __construct(ClassResolver $class_resolver)
    {
        $this->classResolver = $class_resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        if (!$controller = $request->attributes->get('_controller')) {
            return FALSE;
        }
        return $this->getControllerFromDefinition($controller, $request->getPathInfo());
    }

    /**
     * {@inheritdoc}
     */
    public function getControllerFromDefinition($controller, $path = '')
    {
        if (is_array($controller) || (is_object($controller) && method_exists($controller, '__invoke'))) {
            return $controller;
        }

        if (strpos($controller, ':') === FALSE) {
            if (function_exists($controller)) {
                return $controller;
            } elseif (method_exists($controller, '__invoke')) {
                return new $controller;
            }
        }

        $callable = $this->createController($controller);

        if (!is_callable($callable)) {
            throw new \InvalidArgumentException(sprintf('The controller for URI "%s" is not callable.', $path));
        }

        return $callable;
    }

    /**
     * Returns a callable for the given controller.
     *
     * @param string $controller
     *   A Controller string.
     *
     * @return mixed
     *   A PHP callable.
     *
     * @throws \LogicException
     *   If the controller cannot be parsed.
     *
     * @throws \InvalidArgumentException
     *   If the controller class does not exist.
     */
    protected function createController($controller)
    {
        // Controller in the service:method notation.
        $count = substr_count($controller, ':');
        if ($count == 1) {
            list($class_or_service, $method) = explode(':', $controller, 2);
        } // Controller in the class::method notation.
        elseif (strpos($controller, '::') !== FALSE) {
            list($class_or_service, $method) = explode('::', $controller, 2);
        } else {
            throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
        }

        $controller = $this->classResolver->getInstanceFromDefinition($class_or_service);

        return array($controller, $method);
    }

}
