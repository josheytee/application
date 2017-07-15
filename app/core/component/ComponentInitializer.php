<?php

namespace app\core\component;

use app\core\dependencyInjection\ClassResolver;
use Symfony\Component\Yaml\Yaml;
use app\core\repository\ComponentRepository;

/**
 * Description of ComponentInitailizer
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentInitializer {

  /**
   * @var ComponentRepository
   */
  private $repository;

  /**
   * @var ClassResolver
   */
  private $resolver;
  protected $initialized;
  private $components;

  public function __construct(ClassResolver $resolver, ComponentRepository $repository) {

    $this->resolver = $resolver;
    $this->repository = $repository;
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
   *
   * @return type
   */
  public function initializeAll() {
    foreach ($this->getRepo() as $key => $value) {
      $info = $value . DS . $key . '.info.yml';
      $this->components[$key] = $this->initialize(
              $this->getComponentsNamespace($key)
              , Yaml::parse(file_get_contents($info))
      );
    }
    $this->initialized = true;
  }

  public function getComponentsNamespace($component) {
    return 'ntc\\' . $component . '\\' . ucfirst($component);
  }

  public function getRepo() {
    return $this->repository->getRepositories();
  }

  /**
   * get a component by its name
   * @param type $component_name
   * @return type
   */
  public function getByName($component_name) {

    return $this->components[$component_name];
  }

}
