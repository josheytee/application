<?php

namespace app\core\routing;

/**
 * Description of RouteEvents
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
final class RouteEvents {

  /**
   * Name of the event fired during route collection to allow changes to routes.
   *
   * This event is used to process new routes before they get saved, giving
   * modules the opportunity to alter routes provided by any other module. The
   * event listener method receives a \app\core\routing\RouteBuildEvent
   * instance.
   *
   * @Event
   * @var string event constant
   */
  const ALTER = 'route.alter';

}
