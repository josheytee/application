<?php

namespace app\core\event\subscriber;

use app\core\routing\LazyRouteEnhancer;
use app\core\routing\event\RouteBuildEvent;
use app\core\routing\event\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listens to the new routes before they get saved.
 */
class RouteEnhancerSubscriber implements EventSubscriberInterface {

  /**
   * @var \app\core\routing\LazyRouteEnhancer
   */
  protected $routeEnhancer;

  /**
   * Constructs the RouteEnhancerSubscriber object.
   *
   * @param \app\core\routing\LazyRouteEnhancer $route_enhancer
   *   The lazy route enhancer.
   */
  public function __construct(LazyRouteEnhancer $route_enhancer) {
    $this->routeEnhancer = $route_enhancer;
  }

  /**
   * Adds the route_enhancer object to the route collection.
   *
   * @param \app\core\routing\event\RouteBuildEvent $event
   *   The route build event.
   */
  public function onRouteAlter(RouteBuildEvent $event) {
    $this->routeEnhancer->setEnhancers($event->getRouteCollection());
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[RoutingEvents::ALTER][] = array('onRouteAlter', -300);
    return $events;
  }

}
