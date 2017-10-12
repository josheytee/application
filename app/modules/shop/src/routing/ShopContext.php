<?php

namespace ntc\shop\routing;

use app\core\routing\RouteMatchInterface;
use Symfony\Component\Routing\Route;

/**
 * Provides a helper class to determine whether the route is an admin one.
 */
class ShopContext {

  /**
   * The route match.
   *
   * @var RouteMatchInterface
   */
  protected $routeMatch;

    /**
     * Construct a new admin context helper instance.
     *
     * @param RouteMatchInterface $route_match
     *   The route match.
     */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  /**
   * Determines whether the active route is an admin one.
   *
   * @param \Symfony\Component\Routing\Route $route
   *   (optional) The route to determine whether it is an admin one. Per default
   *   this falls back to the route object on the active request.
   *
   * @return bool
   *   Returns TRUE if the route is an admin one, otherwise FALSE.
   */
  public function isShopRoute(Route $route = NULL) {
    if (!$route) {
      $route = $this->routeMatch->getRouteObject();
      if (!$route) {
        return FALSE;
      }
    }
    return (bool) $route->getOption('_shop_route');
  }

}
