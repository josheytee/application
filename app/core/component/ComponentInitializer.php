<?php

namespace app\core\component;

use app\core\dependencyInjection\ClassResolver;
use Symfony\Component\Yaml\Yaml;
use app\core\repository\ComponentRepository;
use app\core\routing\RouteMatchInterface;
use app\core\component\ComponentTargetResolver;

/**
 * Description of ComponentInitailizer
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ComponentInitializer {

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
      $info = $value['path'] . DS . $key . '.info.yml';
      $manifest = $value['path'] . DS . $key . '.manifest.yml';
      if (file_exists($manifest)) {
        $this->components[$key] = $this->resolver->getInstanceFromDefinition($this->getComponentsNamespace($key, $manifest), Yaml::parse(file_get_contents($info))
        );
      } else {
        $this->components[$key] = $this->resolver->getInstanceFromDefinition($this->getComponentsNamespace($key), Yaml::parse(file_get_contents($info)));
      }
      $this->initialized = true;
    }
  }

  public function getComponentsNamespace($component, $manifest = '') {
    if ($manifest) {
      $manifest = Yaml::parse(file_get_contents($manifest));
      return $manifest['_class'];
    }
    return 'ntc\\' . $component . '\\' . ucfirst($component);
  }

  public function getRepo() {
    return $this->target_resolver->resolveTarget(\app\core\Context::routeMatch());
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
