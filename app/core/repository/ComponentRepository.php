<?php

namespace app\core\repository;

use Symfony\Component\Yaml\Yaml;

/**
 * Description of ComponentRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentRepository extends Repository {

    protected $components_dir;
    protected $module_repository;

    public function __construct() {
        $this->setDirectories($this->getComponentDirs());
        $this->handler = handler\ComponentRepositoryHandler::class;
        parent::__construct();
    }

    public function getComponentsFromUsers() {
        return [];
    }

    public function getComponentsFromModules(ModuleRepository $moduleRepository) {
        foreach ($moduleRepository->getRepositories() as $repository) {
            if (is_dir($repository->getPath() . DS . 'components')) {
                $components[] = $repository->getPath() . DS . 'components';
            }
        }
        return $components;
    }

    /**
     * get components from the user directory, components directory and module directory
     * and merges all together
     * @return array
     */
    public function getComponentDirs() {
        return $this->components_dir = array_merge((array)_COMPONENT_DIR_, $this->getComponentsFromModules(new ModuleRepository()),
            $this->getComponentsFromUsers());
    }

    public function getTargetComponents($target) {
        foreach ($this->getRepositories() as $name => $path) {
            $info = $path . DS . $name . '.info.yml';
            $yml = Yaml::parse(file_get_contents($info));
            if (isset($yml['target']) && $target == $yml['target'])
                $components[$name] = $yml + ['path' => $path];
        }
        return $components;
    }
}
