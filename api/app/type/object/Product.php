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
                    'condition' => Type::string(),
                    'type' => Type::string(),
                    'availability' => Type::boolean(),
                    'meta_title' => Type::string(),
                    'meta_description' => Type::string(),
                    'meta_keywords' => Type::string(),
                    'link_rewrite' => Type::string(),
                    'quantity' => Type::int(),
                    'quantity_discount' => Type::int(),
                    'minimal_discount' => Type::float(),
                    'active' => Type::boolean(),
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
