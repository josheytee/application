<?php

namespace api\app\type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class Mutation extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'NaijaTradeCenterMutations',
            'description' => 'The root mutation object of the entire website',
            'fields' => [
                'sum' => [
                    'type' => Type::int(),
                    'args' => [
                        'x' => ['type' => Type::int()],
                        'y' => ['type' => Type::int()],
                    ]
                ]
            ],
            'resolveField' => function ($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    function sum($root, $args)
    {
        return $args['x'] + $args['y'];
    }

}
