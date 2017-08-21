<?php

namespace api\app\type\object;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use api\app\Types;

/**
 * Description of Section
 *
 * @author Tobi
 */
class Section extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Section',
            'description' => 'Section of products in a shop',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Type::id(),
                        'resolve' => function ($section) {
                            return $section->id_section;
                        }
                    ],
                    'parent' => [
                        'type' => Types::section(),
//                        'resolve' => function ($section) {
//                            return $section->id_parent;
//                        }
                    ],
                    'shop' => [
                        'type' => Types::shop(),
                    ],
                    'name' => Type::string(),
                    'description' => Type::string(),
                    'url' => Type::string(),
                    'created_at' => Type::string(),
                    'updated_at' => Type::string(),
                    'product' => [
                        'type' => Types::product(),
                        'args' => [
                            'id' => Type::id(),
                        ]
                    ],
                    'products' => [
                        'type' => Type::listOf(Types::product()),
                    ],
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
