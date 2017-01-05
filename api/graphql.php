<?php

// Test this using following command
// php -S localhost:8080 ./graphql.php
require_once '../vendor/autoload.php';

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Schema;
use GraphQL\GraphQL;

try {
    $userType = new ObjectType([
        'name' => 'User',
        'description' => 'wooo woooo first user object created nice guy ',
        'fields' => [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'resolve' => function($user) {
                    return $user['id'];
                }
            ],
            'firstname' => Type::string(),
            'lastname' => Type::string(),
            'username' => Type::string(),
            'email' => Type::string(),
            'date_upd' => Type::string(),
            'date_add' => Type::string()
        ]
    ]);
    $usersType = new ObjectType([
        'name' => 'Users',
        'description' => 'wooo woooo first user object created nice guy ',
        'fields' => [
            'users' => [
                'type' => Type::listOf($userType),
                'args' => [
                ]
            ]
        ]
    ]);

    $queryType = new ObjectType([
        'name' => 'NaijaTradeCenter',
        'description' => 'The root query object of the entire website',
        'fields' => [
            'user' => [
                'type' => $userType,
                'args' => [
                    'id' => Type::id()
                ],
                'resolve' => function($user, $args) {
                    $users = [
                        1 => [
                            'id' => 1,
                            'firstname' => 'Smith',
                            'lastname' => 'Smith',
                            'username' => 'smith2t',
                            'email' => 'a@b,com',
                            'date_upd' => 'uoshoisu',
                            'date_add' => 'iqjok'
                        ],
                        2 => [
                            'id' => 2,
                            'firstname' => 'John',
                            'lastname' => 'Doe',
                        ]
                    ];
                    $id = isset($args['id']) ? $args['id'] : null;
                    return $users[$id];
                }
            ],
            'users' => [
                'type' => Type::listOf($userType),
                'resolve' => function() {
                    return [
                        1 => [
                            'id' => 1,
                            'firstname' => 'Smith',
                            'lastname' => 'Smith',
                            'username' => 'smith2t',
                            'email' => 'a@b,com',
                            'date_upd' => 'uoshoisu',
                            'date_add' => 'iqjok'
                        ],
                        2 => [
                            'id' => 2,
                            'firstname' => 'John',
                            'lastname' => 'Doe',
                        ]
                    ];
                }
            ],
            'echo' => [
                'type' => Type::string(),
                'args' => [
                    'message' => ['type' => Type::string()],
                ],
                'resolve' => function ($root, $args) {
                    return $root['prefix'] . $args['message'];
                }
            ],
            'hello' => [
                'type' => Type::string(),
                'resolve' => function ($root) {
                    return 'hello world';
                }
            ]
        ],
    ]);

    $mutationType = new ObjectType([
        'name' => 'Calc',
        'fields' => [
            'sum' => [
                'type' => Type::int(),
                'args' => [
                    'x' => ['type' => Type::int()],
                    'y' => ['type' => Type::int()],
                ],
                'resolve' => function ($root, $args) {
                    return $args['x'] + $args['y'];
                },
            ],
        ],
    ]);

    $schema = new Schema([
        'query' => $queryType,
        'mutation' => $mutationType,
    ]);

    // Parse incoming query and variables
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true);
    } else {
        $data = $_REQUEST;
    }
    $data += ['query' => null, 'variables' => null];

    if (null === $data['query']) {
        $data['query'] = '{hello}';
    }
    $rootValue = ['prefix' => 'You said: '];
    $result = GraphQL::execute($schema, $data['query'], $rootValue);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);

