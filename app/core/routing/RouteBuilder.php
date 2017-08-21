<?php

namespace app\core\routing;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Yaml\Yaml;
use app\core\module\ModuleManager;
use app\core\routing\Dumper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use app\core\routing\event\RouteBuildEvent;
use app\core\routing\event\RoutingEvents;

/**
 * Description of RouteBuilder
 *
 * @author adapter
 */
class RouteBuilder {

  /**
   * @var Dumper
   */
  private $dumper;

  /**
   * @var EventDispatcherInterface
   */
  private $dispatcher;
  private $manager;
  protected $building;
  protected $rebuild_needed;

  public function __construct(ModuleManager $manager, Dumper $dumper, EventDispatcherInterface $dispatcher) {
    $this->manager = $manager;
    $this->dispatcher = $dispatcher;
    $this->dumper = $dumper;
  }

  public function build() {

  }

  /**
   * {@inheritdoc}
   */
  public function setRebuildNeeded() {
    $this->rebuild_needed = TRUE;
  }

  public function rebuildIfNeeded() {
    if ($this->rebuild_needed) {
      return $this->rebuild();
    }
    return FALSE;
  }

  public function rebuild() {
    if ($this->building) {
      throw new \RuntimeException('Recursive router rebuild detected.');
    }
    $this->building = TRUE;
    $collection = new RouteCollection();
    foreach ($this->getRouteDefinitions() as $name => $route_info) {
      $route_info += array(
          'defaults' => array(),
          'requirements' => array(),
          'options' => array(),
          'host' => NULL,
          'schemes' => array(),
          'methods' => array(),
          'condition' => '',
      );

      $route = new Route($route_info['path'], $route_info['defaults'], $route_info['requirements'], $route_info['options'], $route_info['host'], $route_info['schemes'], $route_info['methods'], $route_info['condition']);
      $collection->add($name, $route);
    }
    $route_build_event = $this->dispatcher->dispatch(RoutingEvents::ALTER, new RouteBuildEvent($collection));
    $this->dumper->addRoutes($route_build_event->getRouteCollection());
    $this->dumper->dump();
    $this->building = FALSE;

    $this->rebuildNeeded = FALSE;

    return TRUE;
  }

  /**
   * get all available routes form modules
   * @return \app\core\routingr\RouteCollection
   */
  public function getRouteDefinitions() {
    foreach ($this->manager->getModulesDirectory() as $dir => $dir_path) {
      $yml_route_files[] = $dir_path . DS . $dir . '.route.yml';
    }
    $parsed_yml_route_files = array();
    foreach ($yml_route_files as $yml_route_file) {
      if (file_exists($yml_route_file)) {
        $parsed_yml_route_files = array_merge($parsed_yml_route_files, (array) Yaml::parse(file_get_contents($yml_route_file)));
      }
    }
    return $parsed_yml_route_files;
  }

}
