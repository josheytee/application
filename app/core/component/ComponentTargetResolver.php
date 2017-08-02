<?php

namespace app\core\component;

use app\core\routing\RouteMatchInterface;
use app\core\repository\ComponentRepository;

/**
 * Description of ComponentTargetResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentTargetResolver implements ComponentTargetResolverInterface {

  private $resolvers;
  private $sorted_resolvers;

  public function appliesTo(RouteMatchInterface $route_match): bool {
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
  public function addResolver(ComponentTargetResolverInterface $resolver, $priority) {
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
// Sort the resolvers according to priority.
      krsort($this->resolvers);
// Merge nested negotiators from $this->negotiators into
      $this->sorted_resolvers = array();
      foreach ($this->resolvers as $resolver) {
        $this->sorted_resolvers = array_merge($this->sorted_resolvers, $resolver);
      }
    }
    return $this->sorted_resolvers;
  }

  public function resolveTarget(RouteMatchInterface $route_match) {
    foreach ($this->getSortedResolvers() as $resolver) {
      if ($resolver->appliesTo($route_match)) {
        $components = $resolver->resolveTarget($route_match);
//        if ($theme !== NULL && $this->themeAccess->checkAccess($theme)) {
        return $components;
//        }
      }
    }
  }

}
