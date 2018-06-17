<?php

namespace api\app\type\object;

use api\app\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Description of Shop
 *
 * @author Tobi
 */
class Shop extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Shop',
            'description' => 'collection of sections and addresses',
            'fields' => function () {
                return [
                    'id' => [
                        'type' => Type::id(),
                        'resolve' => function ($shop) {
                            return $shop->id;
                        }
                    ],
                    'name' => [
                        'type' => Type::string(),
                    ],
                    'category' => [
                        'type' => Types::category(),
                    ],
                    'users' => [
                        'type' => Type::listOf(Types::user()),
                    ],
                    'sections' => [
                        'type' => Type::listOf(Types::section()),
                    ],
                    'description' => Type::string(),
                    'url' => Type::string(),
                    'created_at' => Type::string(),
                    'updated_at' => Type::string()
                ];
            },
            'resolveField' => function ($value, $args, $context, ResolveInfo $info) {
                if (method_exists($this, $info->fieldName)) {
                    return $this->{$info->fieldName}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            },
            'resolve' => function ($shop, $args, $context, ResolveInfo $info) {
                var_dump($info);
                echo "not found";
            }
        ];
        parent::__construct($config);
    }

}
