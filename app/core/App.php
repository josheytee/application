<?php

namespace app\core;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\AppInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use app\core\Context;

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
    protected $enviroment;
    private $booted;

    public function __construct($class_loader) {
        $this->root = _ABSOLUTE_ROOT_DIR_;
        $this->classLoader = $class_loader;
    }

    public function initializeRequest(Request $request) {
        $this->matcher = new UrlMatcher($this->getRoute(), new Routing\RequestContext());
        $this->matcher->getContext()->fromRequest($request);
        $request->attributes->add($this->matcher->match($request->getPathInfo()));
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
        $this->boot();
        $this->initializeRequest($request);
        try {
            $response = $this->getHttpKernel()->handle($request, $type, $catch);
            $response = new template\skeleton\TemplateSkeleton($response->getContent(), 200);
        } catch (ResourceNotFoundException $e) {
            echo $e->getMessage();
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return new Response('An error occurred', 500);
        }
        // Adapt response headers to the current request.
        $response->prepare($request);

        return $response;
    }

    /**
     * return directory as key and its path as value
     * @return array
     */
    public function getModulesDir() {
        return module\ModuleManager::getModulesDirectory();
    }

    public function getRoute() {
        foreach ($this->getModulesDir() as $dir => $dir_path) {
            $yml_route_files[] = $dir_path . DS . $dir . '.route.yml';
        }
        $parsed_yml_route_files = [];
        foreach ($yml_route_files as $yml_route_file) {
            if (file_exists($yml_route_file)) {
                $parsed_yml_route_files += \Symfony\Component\Yaml\Yaml::parse(file_get_contents($yml_route_file));
            }
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
            $namespaces["ntc\\$module"] = dirname($filename) . '/src';
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
//        var_dump($namespaces);
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
        if ($this->booted) {
            throw new \Exception('The container cannot be set after a booted kernel.');
        }

        $this->container = $container;
        return $this;
    }

    public function terminate(Request $request, Response $response) {

    }

    /**
     * gets Module data using the module.info.yml file
     * @return
     */
    public function getModuleData() {
        foreach ($this->getModulesDir() as $dir => $dir_path) {
            if (!file_exists($dir_path . DS . $dir . '.info.yml')) {
                continue;
            }
            $module[$dir] = ($dir_path . DS . $dir . '.info.yml');
        }
        return $module;
    }

    public function getContainerBuilder() {
        return new ContainerBuilder();
    }

    public function initializeContainer() {
        if (isset($this->container)) {

        }
        $this->container = $this->compileContainer();
    }

    public function compileContainer() {
        $container = $this->getContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__));

        $container->set('kernel', $this);
//        $container->setParameter('container.modules', $this->getModulesParameter());
        // Register synthetic services.
        $container->register('kernel', 'Symfony\Component\HttpKernel\KernelInterface')->setSynthetic(TRUE);
        $container->register('service_container', 'Symfony\Component\DependencyInjection\ContainerInterface')->setSynthetic(TRUE);

        $loader->load('core.services.yml');

        $container->compile();
//        var_dump($container);
        Context::setContainer($container);
        return $container;
    }

    /**
     * Gets a http kernel from the container
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected function getHttpKernel() {
        return $this->container->get('http_kernel');
    }

    public function boot() {

        $module_filenames = $this->getModuleData();
        $this->classLoaderAddMultiplePsr4($this->getModuleNamespacesPsr4($module_filenames));
        $this->initializeContainer();

        $this->booted = true;
    }

    public function getContainer(): ContainerInterface {
        return $this->container;
    }

    public function getEnvironment(): string {
        return $this->enviroment;
    }

    public function getName(): string {

    }

    public function getRootDir(): string {

    }

    public function isDebug(): bool {

    }

    public function registerContainerConfiguration(LoaderInterface $loader) {

    }

    public function shutdown() {

    }

}
