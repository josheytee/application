<?php

namespace api\app\type\object;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use api\app\Types;

/**
 * Description of Product
 *
 * @author Tobi
 */
class Product extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Product',
            'description' => 'Products in a Section in a shop',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Type::id(),
                        'resolve' => function ($product) {
                            return $product->id_product;
                        }
                    ],
                    'shop' => [
                        'type' => Types::shop(),
                    ],
                    'section' => [
                        'type' => Types::section(),
                    ],
                    'name' => Type::string(),
                    'description' => Type::string(),
                    'price' => Type::float(),
                    'availability' => Type::boolean(),
                    'created_at' => Type::string(),
                    'updated_at' => Type::string()
                ];
            },
            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
                if (method_exists($this, $info->fieldName)) {
                    return $this->{$info->fieldName}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            }
        ];
        parent::__construct($config);
    }

}
