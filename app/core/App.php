<?php

namespace app\core;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\AppInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Description of Framework
 *
 * @author Tobi
 */
class App implements AppInterface, TerminableInterface {

    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;
    protected $container;

    /**
     * The class loader object.
     *
     * @var \Composer\Autoload\ClassLoader
     */
    protected $classLoader;
    private $root;

    public function __construct($class_loader) {
        $this->classLoader = $class_loader;
        $this->matcher = new UrlMatcher($this->getRoute(), new Routing\RequestContext());
        $this->controllerResolver = new ControllerResolver();
        $this->argumentResolver = new ArgumentResolver();

        $module_filenames = $this->getModuleFileNames();
        $this->classLoaderAddMultiplePsr4($this->getModuleNamespacesPsr4($module_filenames));
    }

    public function getRoute() {
        $finder = new Finder();
        $finder->directories()->in(_MODULES_DIR_)->depth(0);
        foreach ($finder as $dir) {
            $yml_route_files[] = $dir->getPathName() . DS . $dir->getFileName() . '.route.yml';
        }
        $parsed_yml_route_files = [];
        foreach ($yml_route_files as $yml_route_file) {
            $parsed_yml_route_files += \Symfony\Component\Yaml\Yaml::parse(file_get_contents($yml_route_file));
        }
        $route_collection = new RouteCollection();
        foreach ($parsed_yml_route_files as $route_name => $route_info) {
            $route_info += array(
                'defaults' => array(),
                'requirements' => array(),
                'options' => array(),
                'host' => NULL,
                'schemes' => array(),
                'methods' => array(),
                'condition' => '',
            );
            $route_collection->add($route_name, new Route($route_info['path'], $route_info['defaults'], $route_info['requirements'], $route_info['options'], $route_info['host'], $route_info['schemes'], $route_info['methods'], $route_info['condition'])
            );
        }
        return $route_collection;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);
            $response = call_user_func_array($controller, $arguments);
            if (!$response instanceof Response) {
                $response = new Response($response, 200);
                $response->prepare($request);
            }
            return $response;
        } catch (ResourceNotFoundException $e) {
            echo $e->getMessage();
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return new Response('An error occurred', 500);
        }
    }

    /**
     * Gets the PSR-4 base directories for module namespaces.
     *
     * @param string[] $module_file_names
     *   Array where each key is a module name, and each value is a path to the
     *   respective *.info.yml file.
     *
     * @return string[]
     *   Array where each key is a module namespace like 'Drupal\system', and each
     *   value is the PSR-4 base directory associated with the module namespace.
     */
    protected function getModuleNamespacesPsr4($module_file_names) {
        $namespaces = array();
        foreach ($module_file_names as $module => $filename) {
            $namespaces["NTC\\$module"] = dirname($filename) . '/src';
        }
        return $namespaces;
    }

    /**
     * Registers a list of namespaces with PSR-4 directories for class loading.
     *
     * @param array $namespaces
     *   Array where each key is a namespace like 'Drupal\system', and each value
     *   is either a PSR-4 base directory, or an array of PSR-4 base directories
     *   associated with this namespace.
     */
    protected function classLoaderAddMultiplePsr4(array $namespaces = array()) {
        var_dump($namespaces);
        foreach ($namespaces as $prefix => $paths) {
            if (is_array($paths)) {
                foreach ($paths as $key => $value) {
//                    $paths[$key] = $this->root . '/' . $value;
                    $paths[$key] = $value;
                }
            } elseif (is_string($paths)) {
//                $paths = $this->root . '/' . $paths;
                $paths = $paths;
            }
            $this->classLoader->addPsr4($prefix . '\\', $paths);
        }
    }

    public function setContainer(ContainerInterface $container = null) {
        if (isset($this->container)) {
            throw new \Exception('The container should not override an existing container.');
        }
//        if ($this->booted) {
//            throw new \Exception('The container cannot be set after a booted kernel.');
//        }

        $this->container = $container;
        return $this;
    }

    public function terminate(Request $request, Response $response) {

    }

    public function getModuleFileNames() {
        $finder = new Finder();
        $finder->depth(0)->directories()->in(_MODULES_DIR_);
        foreach ($finder as $dir) {
            $configDirectories [$dir->getFileName()] = ($dir->getPathName());
            $route_files[$dir->getFileName()] = ($dir->getPathName() . DS . $dir->getFileName() . '.info.yml');
        }
        return $route_files;
    }

}
