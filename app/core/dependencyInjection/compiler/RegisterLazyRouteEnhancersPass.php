<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Registers all lazy route enhancers onto the lazy route enhancers.
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class RegisterLazyRouteEnhancersPass implements CompilerPassInterface
{

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('route_enhancer.lazy_collector')) {
            return;
        }

        $service_ids = [];

        foreach ($container->findTaggedServiceIds('dynamic_router_route_enhancer') as $id => $attributes) {
            $service_ids[$id] = $id;
        }
        $container
            ->getDefinition('route_enhancer.lazy_collector')
            ->addArgument($service_ids);
    }

}
