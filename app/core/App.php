<?php

namespace app\core;

use app\core\http\Response;
use app\core\repository\ComponentRepository;
use app\core\repository\ModuleRepository;
use Composer\Autoload\ClassLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpFoundation\Request as BaseRequest;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Description of Framework
 *
 * @author Tobi
 */
class App implements AppInterface, TerminableInterface
{


    protected $container;

    /**
     * The class loader object.
     *
     * @var ClassLoader
     */
    protected $classLoader;
    protected $enviroment;
    private $root;
    private $booted;

    public function __construct(ClassLoader $class_loader)
    {
        $this->root = _ABSOLUTE_ROOT_DIR_;
        $this->classLoader = $class_loader;
    }

    public function handle(BaseRequest $request, $type = self::MASTER_REQUEST, $catch = TRUE)
    {
        $this->boot();
        try {
            $response = $this->getHttpKernel()->handle($request, $type, $catch);
        } catch (ResourceNotFoundException $e) {
            return new Response('Not Found: <br/>' . $e->getMessage() . ' see trace: <br/ >' . $e->getTraceAsString(), 404);
        } catch (\Exception $e) {
            return new Response('An error occurred: <br/>' . $e->getMessage() . ' see trace: <br/ >' . $e->getTraceAsString(), 500);
        }
        // Adapt response headers to the current request.
        $response->prepare($request);

        return $response;
    }

    public function boot()
    {
        $moduleRepositories = (new ModuleRepository())->getRepositories();
        $componentRepositories = (new ComponentRepository())->getRepositories();
        $this->classLoaderAddMultiplePsr4($this->getModuleNamespacesPsr4($moduleRepositories));
        $this->classLoaderAddMultiplePsr4($this->getComponentNamespacesPsr4($componentRepositories));
        $this->initializeContainer();

        $this->booted = true;
    }

    /**
     * Registers a list of namespaces with PSR-4 directories for class loading.
     *
     * @param array $namespaces
     *   Array where each key is a namespace like 'app\system', and each value
     *   is either a PSR-4 base directory, or an array of PSR-4 base directories
     *   associated with this namespace.
     */
    protected function classLoaderAddMultiplePsr4(array $namespaces = array())
    {
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
//            echo $prefix.'\\';
//            dump($paths);
//            dump($this->classLoader);
            $this->classLoader->addPsr4($prefix . '\\', $paths);
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
     *   Array where each key is a module namespace like 'app\system', and each
     *   value is the PSR-4 base directory associated with the module namespace.
     */
    protected function getModuleNamespacesPsr4($module_file_names)
    {
        $namespaces = array();
        foreach ($module_file_names as $package => $handler) {
            $namespaces[$package][] = $handler->getPath() . '/src';
            if (is_dir($handler->getPath() . '/components'))
                $namespaces[$package][] = $handler->getPath() . '/components';
        }
        return $namespaces;
    }

    /**
     * Gets the PSR-4 base directories for component namespaces.
     *
     * @param string[] $component_file_names
     *   Array where each key is a module name, and each value is a path to the
     *   respective *.info.yml file.
     *
     * @return string[]
     *   Array where each key is a component namespace like 'app\system', and each
     *   value is the PSR-4 base directory associated with the module namespace.
     */
    protected function getComponentNamespacesPsr4($component_file_names)
    {
        $namespaces = array();
        foreach ($component_file_names as $package => $handler) {

            $namespaces[$package] = $handler->getPath();
        }
        return $namespaces;
    }

    public function initializeContainer()
    {
        if (isset($this->container)) {
            // Save the id of the currently logged in user.
            if ($this->container->initialized('current_user')) {
                $current_user_id = $this->container->get('current_user')->id();
            }
        }
        $this->container = $this->compileContainer();

        if (!empty($current_user_id)) {
            $this->container->get('current_user')->setInitialAccountId($current_user_id);
        }
    }

    public function compileContainer()
    {
        $container = $this->getContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__));

        $container->set('kernel', $this);
//        $container->setParameter('container.modules', $this->getModulesParameter());
        // Register synthetic services.
        $container->register('kernel', 'Symfony\Component\HttpKernel\KernelInterface')->setSynthetic(TRUE);
        $container->register('service_container', 'Symfony\Component\DependencyInjection\ContainerInterface')->setSynthetic(TRUE);

        $loader->load('core.services.yml');
        $this->loadModuleServices($loader);
        $this->registerPass($container);

        $container->compile();
//        var_dump($container);
        Context::setContainer($container);
        return $container;
    }

    public function getContainerBuilder()
    {
        return new ContainerBuilder();
    }

    public function loadModuleServices(&$loader)
    {
        foreach ((new ModuleRepository())->getServices() as $service => $path) {
            $loader->load($path);
        }
    }

    public function registerPass(&$container)
    {
        $container->addCompilerPass(new RegisterListenersPass('event.dispatcher', 'listenerTag', 'event_subscriber'));
//    $container->addCompilerPass(new dependencyInjection\compiler\RegisterEventSubscribersPass());
        $container->addCompilerPass(new dependencyInjection\compiler\ArgumentResolverPass());
//    $container->addCompilerPass(new \Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRouteEnhancersPass());
//
//    $container->addCompilerPass(new \Symfony\Cmf\Component\Routing\DependencyInjection\Compiler\RegisterRoutersPass());
        $container->addCompilerPass(new dependencyInjection\compiler\TaggedResolverPass());
        $container->addCompilerPass(new dependencyInjection\compiler\StackedKernelPass());
        $container->addCompilerPass(new dependencyInjection\compiler\RegisterLazyRouteEnhancersPass());
        $container->addCompilerPass(new dependencyInjection\compiler\DoctrineEnumPass());
        $container->addCompilerPass(new dependencyInjection\compiler\RegisterAccessChecksPass());
    }

    /**
     * Gets a http kernel from the container
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    protected function getHttpKernel()
    {
        return $this->container->get('http_kernel');
    }

    public function terminate(BaseRequest $request, BaseResponse $response)
    {

    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        if (isset($this->container)) {
            throw new \Exception('The container should not override an existing container.');
        }
        if ($this->booted) {
            throw new \Exception('The container cannot be set after a booted kernel.');
        }

        $this->container = $container;
        return $this;
    }

    public function getEnvironment(): string
    {
        return $this->enviroment;
    }

    public function getName(): string
    {

    }

    public function getRootDir(): string
    {

    }

    public function isDebug(): bool
    {

    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {

    }

    public function shutdown()
    {

    }

}
