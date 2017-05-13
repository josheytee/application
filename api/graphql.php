<?php

// Test this using following command
// php -S localhost:8080 ./graphql.php
require_once '../vendor/autoload.php';
require_once '../app/config/config.inc.php';

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Schema;
use GraphQL\GraphQL;
use api\app\Types;
use app\core\Cookie;
use app\core\Context;

try {
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
    $cookie = new Cookie('sh-c', '');


    $context = Context::getContext();
    $context->user = \app\model\User::find(1);
    $context->request = $_REQUEST;
    $context->rootUrl = 'http://localhost:8080';
    $schema = new Schema([
        'query' => Types::query(),
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
    $result = GraphQL::execute($schema, $data['query'], $rootValue, $context, (array) $data['variables']);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);

