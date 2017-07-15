<?php

namespace app\core\dependencyInjection;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Description of ClassResolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ClassResolver implements ContainerAwareInterface {

  use ContainerAwareTrait;

  /**
   * {@inheritdoc}
   */
  public function getInstanceFromDefinition($definition, $params = null) {
    if ($this->container->has($definition)) {
      $instance = $this->container->get($definition);
    } else {
      if (!class_exists($definition)) {
        throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $definition));
      }

      if (is_subclass_of($definition, 'app\core\dependencyInjection\ContainerInjectionInterface')) {
        $instance = $definition::inject($this->container);
      } else {
        $instance = new $definition($params);
      }
    }

    if ($instance instanceof ContainerAwareInterface) {
      $instance->setContainer($this->container);
    }

    return $instance;
  }

}
