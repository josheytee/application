<?php

namespace app\core\component;

use Symfony\Component\Yaml\Yaml;
use app\core\repository\ComponentRepository;

/**
 * Description of ComponentProvider
 *
 * @author adapter
 */
class ComponentManager {

  protected $component_repository;

  public function __construct(ComponentRepository $componentRepository) {
    $this->component_repository = $componentRepository;
  }

  public function getComponent($component) {
    return $this->component_repository->getRepositories()[$component];
  }

  /**
   * gets the data of all components in one single array
   * @return Array of components data
   */
  public function getComponentsData() {
    $data = [];
    foreach ($this->component_repository->getRepositories() as $dir => $path) {
      $data[$dir] = Yaml::parse(file_get_contents($path . DS . $dir . '.info.yml'));
    }
    return $data;
  }

  /**
   *
   * @param Component $component
   * @return type array of a single component information
   */
  public function getComponentData($component) {
    return isset($this->getComponentsData()[$component]) ? $this->getComponentsData()[$component] : null;
  }

  /**
   * Get components that belongs to a particular region in the theme
   * @param type $region
   * @return type
   */
  public function getRegionComponents($region) {
    $region_component = [];
    foreach ($this->getComponentsData() as $component => $data) {
      if ($data['region'] == $region) {
        $region_component[$component] = $this->getComponent($component);
      }
    }
    return $region_component;
  }

}
