<?php

namespace app\core\theme;

use app\core\routing\RouteMatchInterface;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
interface ActiveThemeResolverInterface {

  /**
   * Whether this theme resolver should be used to set the theme.
   *
   * @param \app\core\routingRouteMatchInterface $route_match
   *   The current route match object.
   *
   * @return bool
   *   TRUE if this resolver should be used or FALSE to let other negotiators
   *   decide.
   */
  public function applies(RouteMatchInterface $route_match);

  /**
   * Determine the active theme for the request.
   *
   * @param \app\core\routingRouteMatchInterface $route_match
   *   The current route match object.
   *
   * @return string|null
   *   The name of the theme, or NULL if other negotiators, like the configured
   *   default one, should be used instead.
   */
  public function resolveActiveTheme(RouteMatchInterface $route_match);
}
