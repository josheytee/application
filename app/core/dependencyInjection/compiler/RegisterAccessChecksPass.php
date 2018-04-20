<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds services tagged 'access_check' to the access_manager service.
 */
class RegisterAccessChecksPass implements CompilerPassInterface {

  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container) {
    if (!$container->hasDefinition('access.checker')) {
      return;
    }
    // Add services tagged 'access_check' to the access_manager service.
    $access_manager = $container->getDefinition('access.checker.collector');
      foreach ($container->findTaggedServiceIds('access_checker') as $id => $attributes) {
      $applies = array();
      $method = 'check';
      $needs_incoming_request = FALSE;
      foreach ($attributes as $attribute) {
        if (isset($attribute['applies_to'])) {
          $applies[] = $attribute['applies_to'];
        }
        if (isset($attribute['method'])) {
          $method = $attribute['method'];
        }
        if (!empty($attribute['needs_incoming_request'])) {
          $needs_incoming_request = TRUE;
        }
      }
      $access_manager->addMethodCall('addCheckService', array($id, $method, $applies, $needs_incoming_request));
    }
  }

}
