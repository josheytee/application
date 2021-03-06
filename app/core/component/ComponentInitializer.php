<?php

namespace app\core\component;

use app\core\dependencyInjection\ClassResolver;
use app\core\repository\ComponentRepository;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * helps in the initialization of components
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentInitializer
{

    use ContainerAwareTrait;

    protected $initialized;
    /**
     * @var ClassResolver
     */
    private $resolver;
    private $components;
    /**
     * @var ComponentRepository
     */
    private $componentRepository;

    public function __construct(ClassResolver $resolver, ComponentRepository $componentRepository)
    {

        $this->resolver = $resolver;
        $this->componentRepository = $componentRepository;
        $this->initialized = FALSE;
    }

    public function getComponents()
    {
        if (!$this->initialized) {
            $this->initializeAll();
        }
//        dump( $this->components);
        return $this->components;
    }

    /**
     * @return void
     */
    public function initializeAll()
    {
        foreach ($this->componentRepository->getRepositories() as $package => $handler) {
            $this->components[$package] = $this->initialize($handler->getClass(),
                $handler->getInfo() + ['path' => $handler->getPath()]);
        }
        $this->initialized = true;
    }

    public function initialize($component, $details)
    {
        return $this->resolver->getInstanceFromDefinition($component, $details);
    }

    /**
     * get a component by its name
     * @param type $component_name
     * @return type
     */
    public function getByName($component_name)
    {
        if (!$this->initialized) {
            $this->initializeAll();
        }
        return $this->components[$component_name];
    }

}
