<?php

namespace app\core\dependencyInjection\compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Doctrine\DBAL\Types\Type;

/**
 * Description of DoctrineEnumPass
 *
 * @author joshua
 */
class DoctrineEnumPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $get = $container->get('entity.manager');
//        $get->refresh(new \app\core\entity\User());
//        $connection = $get->getConnection();
//        Type::addType('product_type', 'app\core\entity\types\ProductType');
//        Type::addType('product_condition', 'app\core\entity\types\ProductCondition');
//        $connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_type', 'product_type');
//        $connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_condition', 'product_condition');
    }

}
