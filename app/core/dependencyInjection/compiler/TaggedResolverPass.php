<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * TaggedResolverPass uses resolver_collector to add resolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class TaggedResolverPass implements CompilerPassInterface {

  public function process(ContainerBuilder $container) {
    foreach ($container->findTaggedServiceIds('resolver_collector') as $id => $collector_attributes) {
      $tag_collector = $collector_attributes[0]['tag'];
      $definition = $container->getDefinition($id);
      foreach ($container->findTaggedServiceIds('resolver') as $id => $resolver_attributes) {
        $priority = $resolver_attributes[0]['priority'] ?? 1;
        $tag = $resolver_attributes[0]['tag'] ?? 1;
        $handler = $container->getDefinition($id);
//        $interface = 'app\core\theme\ActiveThemeResolverInterface';
//        if (!$refClass->implementsInterface($interface)) {
//          throw new \InvalidArgumentException(sprintf('Service "%s" must implement interface "%s".', $id, $interface));
//        }
        $args = [];
        foreach ($handler->getArguments() as $handler_arguments) {
          $args[] = $container->get($handler_arguments);
        }
        $resolver = new \ReflectionClass($handler->getClass());
        if ($tag_collector == $tag)
          $definition->addMethodCall('addResolver', [$resolver->newInstanceArgs($args ?? null), $priority]);
      }
    }
  }

}
