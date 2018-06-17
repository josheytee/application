<?php

// Test this using following command
// php -S localhost:8080 ./graphql.php
require_once '../vendor/autoload.php';
require_once '../app/config/config.inc.php';

use api\app\Types;
use app\core\Context;
use app\core\Cookie;
use app\core\entity\User;
use GraphQL\GraphQL;
use GraphQL\Schema;

// Turn off all error reporting
error_reporting(0);
try {
    $cookie = new Cookie('sh-c','');

    $context = Context::getContext();
    $context->user = User::find(1);
    $context->request = $_REQUEST;
    $context->rootUrl = 'http://localhost:8080';
    $schema = new Schema([
        'query' => Types::query(),
        'mutation' => Types::mutation(),
    ]);

    // Parse incoming query and variables
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'],'application/json') !== false) {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw,true);
    } else {
        $data = $_REQUEST;
    }
    $data += ['query' => null,'variables' => null];

    if (null === $data['query']) {
        $data['query'] = '{hello}';
    }
    $rootValue = ['prefix' => 'You said: '];

    $result = GraphQL::execute($schema,$data['query'],$rootValue,$context,(array)json_decode($data['variables'],true));
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'code' => $e->getCode(),
            'stack' => $e->getTrace()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);

