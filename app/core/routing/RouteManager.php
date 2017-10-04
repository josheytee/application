<?php

namespace app\core\routing;

use app\core\repository\ModuleRepository;
use app\core\utility\StringHelper;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of RouteProvider
 *
 * @author adapter
 */
class RouteManager {
    use StringHelper;

  /**
   * @var ModuleRepository
   */
  private $module_repository;
  private $filtered_route;

  public function __construct(ModuleRepository $module_repository) {

    $this->module_repository = $module_repository;
  }

  /**
   * get all available routes form modules
   * @return RouteCollection
   */
  public function getAllRoutes() {
    foreach ($this->module_repository->getRepositories() as $id => $info) {
      $yml_route_files[] = $info['path'] . DS . $this->getModuleName($id) . '.route.yml';
    }
    $parsed_yml_route_files = array();
    foreach ($yml_route_files as $yml_route_file) {
      if (file_exists($yml_route_file)) {
        $parsed_yml_route_files = array_merge($parsed_yml_route_files, (array) Yaml::parse(file_get_contents($yml_route_file)));
      }
    }
    return $this->addRoutesToCollection($parsed_yml_route_files);
  }

  private function addRoutesToCollection($routes) {
    $route_collection = new RouteCollection();
    foreach ($routes as $route_name => $route_info) {
      $route_info = array_merge(array(
          'path' => '',
          'defaults' => array(),
          'requirements' => array(),
          'options' => array(),
          'host' => NULL,
          'schemes' => array(),
          'methods' => array(),
          'condition' => '',
              ), (array) $route_info);
      $route_collection->add($route_name, new Route($route_info['path'], $route_info['defaults'], $route_info['requirements'], $route_info['options'], $route_info['host'], $route_info['schemes'], $route_info['methods'], $route_info['condition'])
      );
    }
    return $route_collection;
  }

  public function getRouteByName($name) {
    return $this->getAllRoutes()->get($name);
  }

  public function getAdminRoutes() {
    return $this->filter('^admin.');
  }

  public function getNonAdminRoutes() {
    $this->filter('^[^admin.*]');
    return $this;
  }

  private function filter($exp) {
    $this->filtered_route = [];
    foreach ($this->getAllRoutes()->getIterator() as $name => $route) {
      if (preg_match("#$exp.#", $name)) {
        $this->filtered_route[$name] = $route;
      }
    }
//    return $this->filtered_route;
  }

  public function getRouteCollection() {
    return $this->addRoutesToCollection($this->filtered_route);
  }

}
