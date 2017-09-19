<?php

namespace ntc\administrator\theme;

use app\core\theme\ActiveThemeResolverInterface;
use app\core\routing\RouteMatchInterface;
use app\core\routing\AdminContext;

/**
 * Description of AdminThemeResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminThemeResolver implements ActiveThemeResolverInterface {

  /**
   * @var AdminContext
   */
  private $context;

  public function __construct(AdminContext $context) {

    $this->context = $context;
  }

  public function applies(RouteMatchInterface $route_match): bool {
    return $this->context->isAdminRoute($route_match->getRouteObject());
  }

  public function resolveActiveTheme(RouteMatchInterface $route_match) {
    return 'visitor';
  }

}
