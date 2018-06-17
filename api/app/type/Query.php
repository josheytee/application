<?php

namespace api\app\type;

use api\app\Types;
use app\core\Context;
use app\core\entity\Shop;
use app\core\entity\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class Query extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'NaijaTradeCenter',
            'description' => 'The root query object of the entire website',
            'fields' => [
                'user' => [
                    'type' => Types::user(),
                    'description' => 'Returns user details of the current user'
                ],
                'users' => [
                    'type' => Type::listOf(Types::user()),
                    'description' => 'Returns the list of assocated users in a shop',
                ],
                'shop' => [
                    'type' => Types::shop(),
                    'description' => 'Returns shop by id',
                    'args' => [
                        'id' => Type::nonNull(Type::id())
                    ]
                ],
                'shops' => [
                    'type' => Type::listOf(Types::shop()),
                    'description' => 'Returns the list of assocated shops for the current user',
                ],
                'me' => [
                    'description' => 'Return the name of the current user',
                    'type' => Type::string()
                ],
                'hello' => Type::string()
            ],
            'resolveField' => function ($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    public function user($user, $args, Context $context)
    {
        return User::find($context->user->id);
    }

    public function me($user, $args, Context $context)
    {
        return $context->user->firstname . ' ' . $context->user->lastname;
    }

    public function users($user, $args)
    {
        return User::all();
    }

    public function shop($shop, $args)
    {
        if (isset($args['id'])) {
            return Shop::find($args['id']);
        }
    }

    public function shops($shops, $args)
    {
        return Shop::all();
    }

    public function hello()
    {
        return 'Your graphql-php endpoint is ready! Use GraphiQL to browse API';
    }

}
