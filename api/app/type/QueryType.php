<?php

namespace api\app\type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType {

    public function __construct() {
        $config = [
            'name' => 'Query',
            'fields' => [
//                'user' => [
//                    'type' => new TypeUser(),
//                    'description' => 'Returns user by id (in range of 1-5)',
//                    'args' => [
//                        'id' => Type::nonNull(Type::id())
//                    ]
//                ],
                'lastStoryPosted' => [
                    'type' => Types::story(),
                    'description' => 'Returns last story posted for this blog'
                ],
                'deprecatedField' => [
                    'type' => Types::string(),
                    'deprecationReason' => 'This field is deprecated!'
                ],
                'fieldWithException' => [
                    'type' => Types::string(),
                    'resolve' => function() {
                        throw new \Exception("Exception message thrown in field resolver");
                    }
                ],
                'hello' => Type::string()
            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }

    public function user($rootValue, $args) {
        return DataSource::findUser($args['id']);
    }

    public function hello() {
        return 'Your graphql-php endpoint is ready! Use GraphiQL to browse API';
    }

    public function deprecatedField() {
        return 'You can request deprecated field, but it is not displayed in auto-generated documentation by default.';
    }

}
