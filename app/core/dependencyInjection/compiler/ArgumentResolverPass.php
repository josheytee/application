<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Description of ArgumentResolverPass
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ArgumentResolverPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('argument_resolver')) {
            return;
        }
        $definition = $container->getDefinition('argument_resolver');

        $argumentValueResolvers = [];
        foreach ($container->findTaggedServiceIds('argument.value_resolver') as $id => $attributes) {
            $argumentValueResolvers[] = $container->get($id);
        }
        $definition->addArgument(null);
        $definition->addArgument($argumentValueResolvers);
    }

}
