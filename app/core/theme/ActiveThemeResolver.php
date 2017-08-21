<?php

namespace app\core\theme;

use app\core\routing\RouteMatchInterface;

/**
 * Description of ThemeHandler
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ActiveThemeResolver implements ActiveThemeResolverInterface {

  private $sorted_resolvers;
  private $resolvers;

  public function __construct($resolvers = []) {
    $this->resolvers = $resolvers;
  }

  public function applies(RouteMatchInterface $route_match): bool {
    return true;
  }

  /**
   * Adds a active theme resolver service.
   *
   * @param \app\core\theme\ActiveThemeResolverInterface $resolver
   *   The theme resolver to add.
   * @param int $priority
   *   Priority of the theme resolver.
   */
  public function addResolver(ActiveThemeResolverInterface $resolver, $priority) {
    $this->resolvers[$priority][] = $resolver;
// Force the resolvers to be re-sorted.
    $this->sorted_resolvers = NULL;
  }

  /**
   * Returns the sorted array of theme negotiators.
   *
   * @return array|\app\core\theme\ActiveThemeResolverInterface[]
   *   An array of theme negotiator objects.
   *
   *
   * @return \app\core\theme\ActiveThemeResolverInterface[]|array
   */
  public function getSortedResolvers() {

    if (!isset($this->sorted_resolvers)) {
// Sort the negotiators according to priority.
      krsort($this->resolvers);
// Merge nested negotiators from $this->negotiators into
// $this->sortedNegotiators.
      $this->sorted_resolvers = array();
      foreach ($this->resolvers as $builders) {
        $this->sorted_resolvers = array_merge($this->sorted_resolvers, $builders);
      }
    }
    return $this->sorted_resolvers;
  }

  public function resolveActiveTheme(RouteMatchInterface $route_match) {

    foreach ($this->getSortedResolvers() as $resolver) {
      if ($resolver->applies($route_match)) {
        $theme = $resolver->resolveActiveTheme($route_match);
//        if ($theme !== NULL && $this->themeAccess->checkAccess($theme)) {
        return $theme;
//        }
      }
    }
  }

}
