<?php

namespace app\core\service;

use GuzzleHttp\Client;

/**
 * Description of Graphql
 *
 * @author Tobi
 */
class Graphql {

    public function __construct() {
        ;
    }

    public function query($GQL) {
        $s = preg_replace("[\n,\r,' ']", '', $GQL);
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8080/graphql.php', [
            'query' => ['query' => $s]
                ]
        );
        $r = $res->getBody();
        return $r;
    }

}
