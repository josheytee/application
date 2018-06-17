<?php

namespace app\core\theme\library;

use app\core\routing\RouteMatchInterface;
use app\core\theme\ThemeManager;

/**
 * Description of LibraryManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class LibraryManager
{
    const TYPE_JS = 'js';
    const TYPE_CSS = 'css';
    const TYPE_CUSTOM = 'custom';

    const ROUTE_ALL = 'all';
    const ROUTE_GROUP = 'groups';

    /**
     * @var ThemeManager
     */
    private $themeManager;
    private $activeTheme;
    /**
     * @var LibraryHandlerResolver
     */
    private $libraryResolver;

    public function __construct(ThemeManager $themeManager,LibraryHandlerResolver $libraryResolver)
    {
        $this->themeManager = $themeManager;
        $this->activeTheme = $this->themeManager->getActiveTheme();
        $this->libraryResolver = $libraryResolver;
    }

    public function getLibraries($section = null)
    {
        return $this->activeTheme->getLibraries($section);
    }

    public function getDefinitions()
    {
        return $this->getLibraries('definitions') ?? [];
    }

    public function getRoutes()
    {
        return $this->getLibraries('routes') ?? [];
    }

    public function getRoute($route)
    {
        return $this->getRoutes()[$route] ?? [];
    }

    public function loadLibrary($library,$type)
    {
        return $this->getDefinitions()[$library][$type] ?? [];
    }

    public function getAllDefinition($route)
    {
        $allRoutes = $this->getRoute(self::ROUTE_ALL);
        if (isset($allRoutes['except']) && in_array($route,$allRoutes['except'])) {
            return [];
        }
        return $allRoutes['files'] ?? [];
    }

    public function getGroupDefinition($route)
    {
        $groupDef = [];
        $groupRoutes = $this->getRoute(self::ROUTE_GROUP);
        foreach ($groupRoutes as $name => $definitions) {
            if (in_array($route,$definitions['routes'])) {
                $groupDef = $this->array_add($groupDef,$definitions['files']);
            }
        }
        return $groupDef;
    }

    public function getLibrariesForRoute($route)
    {
        $all = $this->getAllDefinition($route);
        $rout = $this->getRoute($route);
        $group = $this->getGroupDefinition($route);
        return $this->array_add($all,$group,$rout);
    }

    /**
     * union operator is used here because the array comm=ing is value paired
     * @param $route
     * @param $type
     * @return array
     */
    public function loadTemplateLibraries($route,$type)
    {
        $libraries = [];
        foreach ($this->getLibrariesForRoute($route) as $def) {
            $libraries = array_merge($libraries,$this->libraryResolver->resolveLibrary($this->loadLibrary($def,$type),$type));
        }
        return $libraries;
    }


    public function loadLibraries(RouteMatchInterface $routeMatch)
    {
        $route = $routeMatch->getRouteName();
        $return = [];
        foreach ($this->libraryResolver->getHandlers() as $handler) {
            $return[$handler->key()] = $this->loadTemplateLibraries($route,$handler->key());
        }
        return $return;
    }

    /**
     * @todo make this function a global one
     * @param array ...$arrays
     * @return array
     */
    protected function array_add(...$arrays)
    {
        $merged = [];
        foreach ($arrays as $array)
            $merged = array_unique(array_merge($merged,$array));
        return $merged;
    }
}
