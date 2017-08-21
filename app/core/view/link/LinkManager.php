<?php

namespace app\core\view\link;

use app\core\routing\RouteManager;
use app\core\cache\CacheManager;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * Description of Link
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class LinkManager {

  /**
   * @var CacheManager
   */
  private $cache;

  /**
   * @var RouteManager
   */
  private $route_manager;

  public function __construct(RouteManager $route_manager, CacheManager $cache) {

    $this->route_manager = $route_manager;
    $this->cache = $cache;
  }

  public function route($route_name, $params = []) {
    $path = $this->route_manager->getRouteByName($route_name)->getPath();
    preg_match_all('/{\w+}/', $path, $match);
    $placeholders = array_shift($match);
    array_walk($placeholders, function (&$placeholder) {
      $placeholder = '/' . $placeholder . '/';
    });
    return '/application' . preg_replace($placeholders, $params, $path);
  }

  public function generate($param) {
    return (new UrlGenerator($this->route_manager->getAllRoutes(), new \Symfony\Component\Routing\RequestContext()))->generate($param, ['id' => 1]);
  }

}
