<?php

namespace app\core\repository;

use app\core\repository\ComponentRepository;
use app\core\repository\ModuleRepository;

/**
 * ModuleComponentRepository represents components directories inside module directory
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ModuleComponentRepository extends ComponentRepository {

  protected $module_repository;

  public function __construct(ModuleRepository $module_repository) {
    $this->module_repository = $module_repository;
    $this->setDirectories($this->getComponentsFromModules());
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

  public function getComponentDirs() {
    return $this->components_dir = $this->getComponentsFromModules();
  }

}
