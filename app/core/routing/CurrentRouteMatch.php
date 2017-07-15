<?php

namespace app\core\routing;

use app\core\routing\RouteMatch;
use Symfony\Component\HttpFoundation\RequestStack;
use app\core\http\Request;

/**
 * Description of CurrentRouteMatch
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CurrentRouteMatch implements RouteMatchInterface {

  /**
   * @var RequestStack
   */
  private $request_stack;
  private $route_matches;

  public function __construct(RequestStack $request_stack) {

    $this->request_stack = $request_stack;
    $this->route_matches = new \SplObjectStorage();
  }

  /**
   * Returns the route match for the current request.
   *
   * @return \app\core\routing\RouteMatchInterface
   *   The current route match object.
   */
  public function getCurrentRouteMatch() {
    return $this->getRouteMatch($this->request_stack->getCurrentRequest());
  }

  public function getParameter($parameter_name) {
    return $this->getCurrentRouteMatch()->getParameter($parameter_name);
  }

  public function getParameters() {
    return $this->getCurrentRouteMatch()->getParameters();
  }

  public function getRouteName() {
    return $this->getCurrentRouteMatch()->getRouteName();
  }

  public function getRouteObject() {
    return $this->getCurrentRouteMatch()->getRouteObject();
  }

  /**
   * Returns the route match for a passed in request.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   A request object.
   *
   * @return \app\core\routing\RouteMatchInterface
   *   A route match object created from the request.
   */
  protected function getRouteMatch(Request $request) {
    if (isset($this->route_matches[$request])) {
      $route_match = $this->route_matches[$request];
    } else {
      $route_match = RouteMatch::createFromRequest($request);

      // Since getRouteMatch() might be invoked both before and after routing
      // is completed, only statically cache the route match after there's a
      // matched route.
      if ($route_match->getRouteObject()) {
        $this->route_matches[$request] = $route_match;
      }
    }
    return $route_match;
  }

  /**
   * Returns a route match from a given request, if possible.
   *
   * @param \Symfony\Component\HttpFoundation\Request
   *   The request.
   *
   * @return \app\core\routing\RouteMatchInterface|NULL
   *   THe matching route match, or NULL if there is no matching one.
   */
  public function getRouteMatchFromRequest(Request $request) {
    return $this->getRouteMatch($request);
  }

}
