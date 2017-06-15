<?php

namespace app\core\repository;

use app\core\repository\ModuleRepository;
use app\core\repository\CoreRepository;

/**
 * Description of ComponentRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentRepository extends Repository {

    protected $components_dir;
    protected $module_repository;

    public function __construct(ModuleRepository $module_repository) {
        $this->module_repository = $module_repository;
        $this->setDirectories($this->getComponentDirs());
        parent::__construct();
    }

    /**
     * Gets all components dirs from the module directory
     * @return array of components
     */
    public function getComponentsFromModules() {
        foreach ($this->module_repository->getRepositories() as $path) {
            if (is_dir($path . DS . 'components')) {
                $components[] = $path . DS . 'components';
            }
        }
        return $components;
    }

    public function getComponentsFromUsers() {
        return [];
    }

    /**
     * get components from the user directory, components directory and module directory
     * and merges all together
     * @return array
     */
    public function getComponentDirs() {
        return $this->components_dir = array_merge((array) _COMPONENT_DIR_, $this->getComponentsFromUsers(), $this->getComponentsFromModules());
    }

}
