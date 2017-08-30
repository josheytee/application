<?php

namespace app\core\controller;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * common features needed in controller
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait ControllerTrait {

    /**
     * Generates a URL from the given parameters.
     *
     * @param string $route         The name of the route
     * @param mixed  $parameters    An array of parameters
     * @param int    $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH) {
        return $this->container->get('url.generator')->generate($route, $parameters, $referenceType);
    }

    /**
     * Returns a RedirectResponse to the given route with the given parameters.
     *
     * @param string $route      The name of the route
     * @param array  $parameters An array of parameters
     * @param int    $status     The status code to use for the Response
     *
     * @return RedirectResponse
     */
    protected function redirect($route, array $parameters = array()) {
        return $this->container->get('url.generator')->redirect($route, $parameters);
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineBundle is not available
     */
    protected function doctrine() {
        return \app\core\Context::getContext()->manager;
    }

    public function smarty() {
        return $this->container->get('smarty');
    }

    /**
     * Retrieves the currently active route match object.
     *
     * @return \app\core\routing\RouteMatchInterface
     *   The currently active route match object.
     */
    public function routeMatch() {
        return $this->container->get('current.route.match');
    }

    public function componentManager() {
        return $this->container->get('component.manager');
    }

    public function themeManager() {
        return $this->container->get('theme.manager');
    }

}
