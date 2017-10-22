<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Reference;

/**
 * TaggedResolverPass uses resolver_collector to add resolver
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class TaggedResolverPass implements CompilerPassInterface
{

    /**
     * public function process(ContainerBuilder $container) {
     * foreach ($container->findTaggedServiceIds('resolver_collector') as $id => $collector_attributes) {
     * dump($collector_attributes);
     * $tag_collector = $collector_attributes[0]['tag'];
     * $tag_collector = $collector_attributes[0]['call'];
     * $definition = $container->getDefinition($id);
     * foreach ($container->findTaggedServiceIds('resolver') as $id => $resolver_attributes) {
     * $priority = $resolver_attributes[0]['priority'] ?? 1;
     * $tag = $resolver_attributes[0]['tag'] ?? 1;
     * $handler = $container->getDefinition($id);
     * //        $interface = 'app\core\theme\ActiveThemeResolverInterface';
     * //        if (!$refClass->implementsInterface($interface)) {
     * //          throw new \InvalidArgumentException(sprintf('Service "%s" must implement interface "%s".', $id, $interface));
     * //        }
     * $args = [];
     * foreach ($handler->getArguments() as $handler_arguments) {
     * $args[] = $container->get($handler_arguments);
     * }
     * $resolver = new \ReflectionClass($handler->getClass());
     * if ($tag_collector == $tag)
     * $definition->addMethodCall('addResolver', [$resolver->newInstanceArgs($args ?? null), $priority]);
     * }
     * }
     * }
     *
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds('resolver_collector') as $consumer_id => $passes) {
            foreach ($passes as $pass) {
                $tag = isset($pass['tag']) ? $pass['tag'] : $consumer_id;
                $method_name = isset($pass['call']) ? $pass['call'] : 'addHandler';
                $required = isset($pass['required']) ? $pass['required'] : FALSE;

                // Determine parameters.
                $consumer = $container->getDefinition($consumer_id);
                $method = new \ReflectionMethod($consumer->getClass(), $method_name);
                $params = $method->getParameters();

                $interface_pos = 0;
                $id_pos = NULL;
                $priority_pos = NULL;
                $extra_params = [];
                foreach ($params as $pos => $param) {
                    if ($param->getClass()) {
                        $interface = $param->getClass();
                    } elseif ($param->getName() === 'id') {
                        $id_pos = $pos;
                    } elseif ($param->getName() === 'priority') {
                        $priority_pos = $pos;
                    } else {
                        $extra_params[$param->getName()] = $pos;
                    }
                }
                // Determine the ID.

                if (!isset($interface)) {
                    throw new LogicException(vsprintf("Service consumer '%s' class method %s::%s() has to type-hint an interface.", array(
                        $consumer_id,
                        $consumer->getClass(),
                        $method_name,
                    )));
                }
                $interface = $interface->getName();

                // Find all tagged handlers.
                $handlers = array();
                $extra_arguments = array();
                foreach ($container->findTaggedServiceIds($tag) as $id => $attributes) {
                    // Validate the interface.
                    $handler = $container->getDefinition($id);
                    if (!is_subclass_of($handler->getClass(), $interface)) {
                        throw new LogicException("Service '$id' for consumer '$consumer_id' does not implement $interface.");
                    }
                    $handlers[$id] = isset($attributes[0]['priority']) ? $attributes[0]['priority'] : 0;
                    // Keep track of other tagged handlers arguments.
                    foreach ($extra_params as $name => $pos) {
                        $extra_arguments[$id][$pos] = isset($attributes[0][$name]) ? $attributes[0][$name] : $params[$pos]->getDefaultValue();
                    }
                }
                if (empty($handlers)) {
                    if ($required) {
                        throw new LogicException(sprintf("At least one service tagged with '%s' is required.", $tag));
                    }
                    continue;
                }
                // Sort all handlers by priority.
                arsort($handlers, SORT_NUMERIC);

                // Add a method call for each handler to the consumer service
                // definition.
                foreach ($handlers as $id => $priority) {
                    $arguments = array();
                    $arguments[$interface_pos] = new Reference($id);
                    if (isset($priority_pos)) {
                        $arguments[$priority_pos] = $priority;
                    }
                    if (isset($id_pos)) {
                        $arguments[$id_pos] = $id;
                    }
                    // Add in extra arguments.
                    if (isset($extra_arguments[$id])) {
                        // Place extra arguments in their right positions.
                        $arguments += $extra_arguments[$id];
                    }
                    // Sort the arguments by position.
                    ksort($arguments);
//          dump($consumer);
                    $consumer->addMethodCall($method_name, $arguments);
                }
            }
        }
    }

}
