<?php

namespace api\app\type\object;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Description of Category
 *
 * @author Tobi
 */
class Category extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'Category',
            'description' => 'Shop Category',
            'fields' => function () {
                return [
                    'id' => [
                        'type' => Type::id(),
                        'resolve' => function ($category) {
                            return $category->id;
                        }
                    ],
                    'name' => [
                        'type' => Type::string(),
                    ],
                    'description' => Type::string(),
                    'icon' => Type::string(),
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
            }
        ];
        parent::__construct($config);
    }

}
