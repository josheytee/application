<?php

namespace app\core\repository;

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
    parent::__construct();
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
    return $this->components_dir = array_merge((array) _COMPONENT_DIR_, $this->getComponentsFromUsers());
  }

}
