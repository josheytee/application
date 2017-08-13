<?php

namespace app\core\routing\event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Routing\RouteCollection;

/**
 * Description of RouteBuildEvent
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RouteBuildEvent extends Event {

  /**
   * @var RouteCollection
   */
  private $route_collection;

  public function __construct(RouteCollection $route_collection) {
    $this->route_collection = $route_collection;
  }

  public function getRouteCollection() {
    return $this->route_collection;
  }

}
