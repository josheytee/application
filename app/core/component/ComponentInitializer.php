<?php

namespace app\core\component;

use app\core\dependencyInjection\ClassResolver;
use app\core\repository\ComponentRepository;
use app\core\utility\StringHelper;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Yaml\Yaml;

/**
 * helps in the initialization of components
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentInitializer {

    use ContainerAwareTrait;
    use StringHelper;

    /**
     * @var ClassResolver
     */
    private $resolver;
    protected $initialized;
    private $components;
    /**
     * @var ComponentRepository
     */
    private $componentRepository;

    public function __construct(ClassResolver $resolver, ComponentRepository $componentRepository) {

        $this->resolver = $resolver;
        $this->componentRepository = $componentRepository;
        $this->initialized = FALSE;
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
        foreach ($this->componentRepository->getRepositories() as $id => $info) {
//            $info = $info . DS . $id . '.info.yml';
//            $yml = Yaml::parse(file_get_contents($info)) + ['path' => $info];
            $class = $info['package'] . '\\' . ucfirst($this->getModuleName($id));
//            $this->components[str_replace('\\', '_', $yml['package'])] = $this->initialize($class, $yml);
            $this->components[$id] = $this->initialize($class, $info);
        }
        $this->initialized = true;
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
