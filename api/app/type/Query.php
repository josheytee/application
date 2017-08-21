<?php

namespace api\app\type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use app\core\Context;
use api\app\Types;

class Query extends ObjectType {

    public function __construct() {
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
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    public function user($user, $args, Context $context) {

        return \app\model\User::find($context->user->id_user);
    }

    public function me($user, $args, Context $context) {
        return $context->user->firstname . ' ' . $context->user->lastname;
    }

    public function users($user, $args) {
        return \app\model\User::all();
    }

    public function shop($shop, $args) {
        if (isset($args['id'])) {
            return \app\model\Shop::find($args['id']);
        }
    }

    public function shops($shops, $args) {
        return \app\model\Shop::all();
    }

    public function hello() {
        return 'Your graphql-php endpoint is ready! Use GraphiQL to browse API';
    }

}
