<?php

namespace app\core\routing;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Cmf\Component\Routing\PagedRouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Cmf\Component\Routing\PagedRouteCollection;

/**
 * Description of RouteProvider
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RouteProvider implements PagedRouteProviderInterface {

  /**
   * @var EntityManager
   */
  private $entity_manager;

  public function __construct(EntityManager $entity_manager) {
    $this->entity_manager = $entity_manager;
  }

  public function getAllRoutes() {
    return new PagedRouteCollection($this);
  }

  public function getRoutes() {
    $collection = new RouteCollection();
    $routes = $this->entity_manager->getRepository('model\Router')->findAll();
    foreach ($routes as $key => $router) {
      $collection->add($router->name, $router->route);
    }
    return $collection;
  }

  public function getRouteByName($name): Route {
    return $this->getRoutes()->get($name);
  }

  public function getRouteCollectionForRequest(Request $request): RouteCollection {

    return $this->getRoutes();
  }

  /**

   *
   * @param type $names
   * @return array of routes
   */
  public function getRoutesByNames($names) {

  }

  public function getRoutesCount(): int {

  }

  /**
   *
   * @param type $offset
   * @param type $length
   * @return array of routes
   */
  public function getRoutesPaged($offset, $length = null) {

  }

}
