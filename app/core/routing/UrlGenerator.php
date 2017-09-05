<?php

namespace app\core\routing;

use Symfony\Cmf\Component\Routing\ProviderBasedGenerator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\Routing\RequestContext;

/**
 * Description of UrlGenerator
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class UrlGenerator extends ProviderBasedGenerator {

    /**
     * @var RequestStack
     */
    private $request_stack;

    /**
     * @param RouteProviderInterface $provider
     * @param LoggerInterface        $request_stack
     */
    public function __construct(RouteProviderInterface $provider, RequestStack $request_stack) {
        $this->provider = $provider;
        $this->context = new RequestContext();
        $this->request_stack = $request_stack;
    }

    public function generateFromRoute($name, $parameters = array()) {
        $path = $this->generate($name, $parameters);
        $host = $this->context->getHost();
        $scheme = $this->context->getScheme();
        return $scheme . '://' . $host . $path;
    }

    /**
     * Returns a redirect response object for the specified route.
     *
     * @param string $route_name
     *   The name of the route to which to redirect.
     * @param array $route_parameters
     *   (optional) Parameters for the route.
     * @param array $options
     *   (optional) An associative array of additional options.
     * @param int $status
     *   (optional) The HTTP redirect status code for the redirect. The default is
     *   302 Found.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *   A redirect response object that may be returned by the controller.
     */
    public function redirect($route_name, array $route_parameters = []) {
        $url = $this->generateFromRoute($route_name, $route_parameters);
        $request = $this->request_stack->getCurrentRequest();
        dump($this->request_stack);
        $request->attributes->set('_redirect', $url);
    }

}
