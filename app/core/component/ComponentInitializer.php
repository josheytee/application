<?php

namespace app\core\component;

use app\core\dependencyInjection\ClassResolver;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * helps in the initialization of components
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentInitializer {

    use ContainerAwareTrait;

    /**
     * @var ComponentTargetResolverInterface
     */
    private $target_resolver;

    /**
     * @var ClassResolver
     */
    private $resolver;
    protected $initialized;
    private $components;

    public function __construct(ClassResolver $resolver, ComponentTargetResolver $target_resolver) {

        $this->resolver = $resolver;
        $this->initialized = FALSE;
        $this->target_resolver = $target_resolver;
    }

    public function initialize($component, $details) {
        return $this->resolver->getInstanceFromDefinition($component, $details);
    }

    public function getComponents() {
        if (!$this->initialized) {
            $this->initializeAll();
        }
        return $this->components;
    }

    /**
     * @todo rewrite this method
     * @return type
     */
    public function initializeAll() {
        foreach ($this->getRepo() as $key => $value) {
            $class = $value['package'] . '\\' . ucfirst($key);
            $this->components[str_replace('\\', '_', $value['package'])] = $this->initialize($class, $value);
        }
        $this->initialized = true;
    }

    public function getRepo() {
        return $this->target_resolver->resolveTarget($this->container->get('current.route.match'));
    }

    /**
     * get a component by its name
     * @param type $component_name
     * @return type
     */
    public function getByName($component_name) {
        if (!$this->initialized) {
            $this->initializeAll();
        }
        return $this->components[$component_name];
    }

}
