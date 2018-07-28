<?php

namespace app\core\routing;

use app\core\entity\Route;
use Doctrine\ORM\EntityManager;
use Symfony\Cmf\Component\Routing\PagedRouteCollection;
use Symfony\Cmf\Component\Routing\PagedRouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

/**
 * Description of RouteProvider
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RouteProvider implements PagedRouteProviderInterface
{

    /**
     * @var EntityManager
     */
    private $entity_manager;

    public function __construct(EntityManager $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    public function getAllRoutes()
    {
        return new PagedRouteCollection($this);
    }

    public function getRouteByName($name)
    {
        return $this->getRoutes()->get($name);
    }

    public function getRoutes()
    {
        $collection = new RouteCollection();
        $routes = Route::all();

        foreach ($routes as $key => $router) {
            $collection->add($router->name, $router->object);
        }
        return $collection;
    }
//@todo make this function better
    public function getRouteCollectionForRequest(Request $request): RouteCollection
    {

        return $this->getRoutes();
    }

    /**
     *
     * @param type $names
     * @return array of routes
     */
    public function getRoutesByNames($names)
    {

    }

    public function getRoutesCount(): int
    {

    }

    /**
     *
     * @param type $offset
     * @param type $length
     * @return array of routes
     */
    public function getRoutesPaged($offset, $length = null)
    {

    }

}
