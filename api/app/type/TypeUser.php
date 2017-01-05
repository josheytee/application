<?php

namespace api\app\type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Description of TypeUser
 *
 * @author Tobi
 */
class TypeUser extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'User',
            'description' => 'Our blog authors',
            'fields' => function() {
                return [
                    'id' => Types::id(),
                    'email' => Types::email(),
//                    'photo' => [
//                        'type' => Types::image(),
//                        'description' => 'User photo URL',
//                        'args' => [
//                            'size' => Types::nonNull(Types::imageSizeEnum()),
//                        ]
//                    ],
                    'firstName' => [
                        'type' => Types::string(),
                    ],
                    'lastName' => [
                        'type' => Types::string(),
                    ],
                    'lastStoryPosted' => Types::story(),
                    'fieldWithError' => [
                        'type' => Types::string(),
                        'resolve' => function() {
                            throw new \Exception("This is error field");
                        }
                    ]
                ];
            },
//            'interfaces' => [
//                Types::node()
//            ],
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

    public function photo(User $user, $args) {
        return DataSource::getUserPhoto($user->id, $args['size']);
    }

    public function lastStoryPosted(User $user) {
        return DataSource::findLastStoryFor($user->id);
    }

}