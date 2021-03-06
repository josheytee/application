<?php

namespace api\app\type\object;

use api\app\Types;
use app\core\Context;
use app\core\entity\Shop;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Description of TypeUser
 *
 * @author Tobi
 */
class User extends ObjectType
{

    public function __construct()
    {
        $config = [
            'name' => 'User',
            'description' => 'User',
            'fields' => function () {
                return [
                    'id' => [
                        'type' => Type::id(),
                        'resolve' => function ($user) {
                            return $user->id;
                        }
                    ],
                    'current_shop' => [
                        'type' => Types::shop()
                    ],
                    'firstname' => [
                        'type' => Type::string(),
                    ],
                    'lastname' => [
                        'type' => Type::string(),
                    ],
                    'username' => Type::string(),
                    'email' => Types::email(),
                    'phone' => Type::string(),
                    'shop' => [
                        'type' => Types::shop(),
                        'args' => [
                            'id' => Type::id()
                        ]
                    ],
                    'shops' => [
                        'type' => Type::listOf(Types::shop())
                    ],
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

    function current_shop($user, $args, Context $context)
    {
        return $user->currentShop;
    }

}
