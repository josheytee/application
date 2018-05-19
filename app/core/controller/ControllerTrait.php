<?php

namespace app\core\controller;

use app\core\account\AnonymousUser;
use app\core\Context;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * common features needed in controller
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait ControllerTrait
{

    public function smarty()
    {
        return $this->container->get('smarty');
    }

    /**
     * Retrieves the currently active route match object.
     *
     * @return \app\core\routing\RouteMatchInterface
     *   The currently active route match object.
     */
    public function routeMatch()
    {
        return $this->container->get('current.route.match');
    }

    public function componentManager()
    {
        return $this->container->get('component.manager');
    }

    public function themeManager()
    {
        return $this->container->get('theme.manager');
    }

    public function currentUser()
    {
        if ($this->container->get('current_user') instanceof AnonymousUser) {
            throw new AccessDeniedHttpException();
        }
        return $this->container->get('current_user');
    }

    public function currentShop()
    {
        return $this->currentUser()->getCurrentShop();
    }

    /**
     * Returns a RedirectResponse to the given route with the given parameters.
     *
     * @param string $route The name of the route
     * @param array $parameters An array of parameters
     * @param int $status The status code to use for the Response
     *
     * @return RedirectResponse
     */
    protected function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    /**
     * Returns a RedirectResponse to the given URL.
     *
     * @param string $url The URL to redirect to
     * @param int $status The status code to use for the Response
     *
     * @return RedirectResponse
     */
    protected function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string $route The name of the route
     * @param mixed $parameters An array of parameters
     * @param int $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->container->get('url.generator')->generate($route, $parameters, $referenceType);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function doctrine()
    {
        return Context::getContext()->manager;
    }


}
