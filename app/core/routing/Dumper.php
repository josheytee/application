<?php

namespace app\core\routing;

use app\core\entity\Routing;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouteCollection;

/**
 * Description of Dumper
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Dumper {

  /**
   * @var EntityManager
   */
  private $entity_manager;
  private $routes;

  public function __construct(EntityManager $entity_manager) {

    $this->entity_manager = $entity_manager;
  }

  public function dump() {
    $this->entity_manager->getRepository('app\core\entity\Routing')->deleteAll();
    foreach ($this->routes->all() as $name => $route) {

//      $compiled = $route->compile();
//      dump($compiled);
      $router = new Routing();
      $router->setName($name);
      $router->setPath($route->getPath());
      $router->setRoute($route);

      $this->entity_manager->persist($router);
    }
    $this->entity_manager->flush();
    $this->routes = null;
  }

  /**
   * {@inheritdoc}
   */
  public function addRoutes(RouteCollection $routes) {
    if (empty($this->routes)) {
      $this->routes = $routes;
    } else {
      $this->routes->addCollection($routes);
    }
  }

}
