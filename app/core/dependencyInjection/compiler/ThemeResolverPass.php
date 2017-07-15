<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Description of ThemeHandlerPass
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ThemeResolverPass implements CompilerPassInterface {

  public function process(ContainerBuilder $container) {
    if (!$container->hasDefinition('active.theme.resolver')) {
      return;
    }

    $definition = $container->getDefinition('active.theme.resolver');
    foreach ($container->findTaggedServiceIds('theme_resolver') as $id => $attributes) {

      $priority = $attributes[0]['priority'] ?? 1;
      $handler = $container->getDefinition($id);
      $refClass = new \ReflectionClass($handler->getClass());
      $interface = 'app\core\theme\ActiveThemeResolverInterface';
      if (!$refClass->implementsInterface($interface)) {
        throw new \InvalidArgumentException(sprintf('Service "%s" must implement interface "%s".', $id, $interface));
      }
      $args = [];
      foreach ($handler->getArguments() as $handler_arguments) {
        $args[] = $container->get($handler_arguments);
      }
      $object = new \ReflectionClass($handler->getClass());

//      $definition->addResolver($object->newInstanceArgs($args ?? null), $priority);
      $definition->addMethodCall('addResolver', [$object->newInstanceArgs($args ?? null), $priority]);
    }
//    $definition->addResolver(new $boject(), $priority);
  }

}
