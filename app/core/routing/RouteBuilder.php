<?php

namespace app\core\routing;

use app\core\module\ModuleManager;
use app\core\routing\event\RouteBuildEvent;
use app\core\routing\event\RoutingEvents;
use app\core\utility\StringHelper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of RouteBuilder
 *
 * @author adapter
 */
class RouteBuilder {

    use StringHelper;

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
        foreach ($this->getRouteDefinitions() as $moduleId => $route_collection) {
            $collection[$moduleId] = new RouteCollection();
            foreach ($route_collection as $name => $route_info) {
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
                $collection[$moduleId]->add($name, $route);
            }
            $collection[$moduleId]->addOptions(['module' => $moduleId]);
            $route_build_event[$moduleId] = $this->dispatcher->dispatch(RoutingEvents::ALTER, new RouteBuildEvent
            ($collection[$moduleId]));
            $this->dumper->addRoutes($route_build_event[$moduleId]->getRouteCollection());
        }
        $this->dumper->dump();
        $this->building = FALSE;

        $this->rebuildNeeded = FALSE;

        return TRUE;
    }

    /**
     * get all available routes form modules
     * @return RouteCollection
     */
    public function getRouteDefinitions() {
        $route_definitions = [];
//        dump($this->manager->getModulesDirectory());
        foreach ($this->manager->getModulesDirectory() as $id => $info) {
            $yml_route_files[] = $info['path'] . DS . $this->getModuleName($id) . '.route.yml';
            $yml_route = $info['path'] . DS . $this->getModuleName($id) . '.route.yml';
            if (file_exists($yml_route)) {
                $route_definitions[$id] = Yaml::parse(file_get_contents($yml_route));
            }
        }
        $parsed_yml_route_files = [];
        foreach ($yml_route_files as $yml_route_file) {
            if (file_exists($yml_route_file)) {
                $parsed_yml_route_files = array_merge($parsed_yml_route_files, (array)Yaml::parse(file_get_contents($yml_route_file)));
            }
        }
//        dump($route_definitions);
        return $route_definitions;

//        dump($parsed_yml_route_files);
//        return $parsed_yml_route_files;
    }

}
