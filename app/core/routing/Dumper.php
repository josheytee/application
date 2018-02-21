<?php

namespace app\core\routing;

use app\core\entity\Route;
use Symfony\Component\Routing\RouteCollection;
use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Description of Dumper
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Dumper
{

    private $routes;

    public function dump()
    {
//        Route::destroy(Route::all());
        Capsule::table('routes')->truncate();
        foreach ($this->routes->all() as $name => $route) {

//      $compiled = $route->compile();
//      dump($compiled);
            $router = new Route();
            $router->name = $name;
            $router->path = $route->getPath();
            $router->object = $route;
            $router->save();
        }
        $this->routes = null;
    }

    /**
     * {@inheritdoc}
     */
    public function addRoutes(RouteCollection $routes)
    {
        if (empty($this->routes)) {
            $this->routes = $routes;
        } else {
            $this->routes->addCollection($routes);
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}
