<?php

namespace ntc\administrator\event\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouteCollection;
use app\core\routing\RouteBuildEvent;
use app\core\routing\RouteEvents;

/**
 * Description of AdminRequestSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminRouteSubscriber implements EventSubscriberInterface {

  public static function getSubscribedEvents(): array {
    return [RouteEvents::ALTER => ['onAlterRoutes']];
  }

  /**
   * it adds information about routes to request to use by it controller_resolver
   * and route provider
   * @param GetResponseEvent $event
   */
  public function onAdminRequest(RouteCollection $collection) {
    foreach ($collection->all() as $route) {
      if (strpos($route->getPath(), '/admin') === 0 && !$route->hasOption('_admin_route')) {
        $route->setOption('_admin_route', TRUE);
      }
    }
  }

  public function onAlterRoutes(RouteBuildEvent $event) {
    $this->onAdminRequest($event->getRouteCollection());
  }

}
