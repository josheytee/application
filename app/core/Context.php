<?php

namespace app\core;

use app\core\dependencyInjection\ContainerNotInitializedException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Context
 *
 * @author Tobi
 */
class Context
{

    protected static $instance;
    /**
     * The currently active container object, or NULL if not initialized yet.
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface|null
     */
    protected static $container;
    /**
     * @var string
     */
    public $rootUrl;
    /**
     * @var User
     */
    public $user;
    /**
     * @var \mixed
     */
    public $request;
    /**
     * entity manager object for doctrine
     * @var \Doctrine\ORM\EntityManager
     */
    public $manager;

    public function __construct()
    {

    }

    /**
     * Unsets the global container.
     */
    public static function unsetContainer()
    {
        static::$container = NULL;
    }

    /**
     * Retrieves a service from the container.
     *
     * Use this method if the desired service is not one of those with a dedicated
     * accessor method below. If it is listed below, those methods are preferred
     * as they can return useful type hints.
     *
     * @param string $id
     *   The ID of the service to retrieve.
     *
     * @return mixed
     *   The specified service.
     */
    public static function service($id)
    {
        return static::getContainer()->get($id);
    }

    /**
     * Returns the currently active global container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface|null
     *
     * @throws \app\Core\DependencyInjection\ContainerNotInitializedException
     */
    public static function getContainer()
    {
        if (static::$container === NULL) {
            throw new ContainerNotInitializedException('\Context::$container is not initialized yet. \Context::setContainer() must be called with a real container.');
        }
        return static::$container;
    }

    /**
     * Sets a new global container.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     *   A new container instance to replace the current.
     */
    public static function setContainer(ContainerInterface $container)
    {
        static::$container = $container;
    }

    /**
     * Indicates if a service is defined in the container.
     *
     * @param string $id
     *   The ID of the service to check.
     *
     * @return bool
     *   TRUE if the specified service exists, FALSE otherwise.
     */
    public static function hasService($id)
    {
        // Check hasContainer() first in order to always return a Boolean.
        return static::hasContainer() && static::getContainer()->has($id);
    }

    /**
     * Returns TRUE if the container has been initialized, FALSE otherwise.
     *
     * @return bool
     */
    public static function hasContainer()
    {
        return static::$container !== NULL;
    }

    public static function smarty()
    {
        return static::getContainer()->get('smarty');
    }

    public static function doctrine()
    {
        return self::getContext()->manager;
    }

    public static function getContext()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Context();
        }
        return self::$instance;
    }

    public static function componentManager()
    {
        return static::getContainer()->get('component.manager');
    }

    public static function themeManager()
    {
        return static::getContainer()->get('theme.manager');
    }

    public static function urlGenerator()
    {
        return static::getContainer()->get('url.generator');
    }

    /**
     * Retrieves the currently active route match object.
     *
     * @return \app\core\routing\RouteMatchInterface
     *   The currently active route match object.
     */
    public static function routeMatch()
    {
        return static::getContainer()->get('current.route.match');
    }

}
