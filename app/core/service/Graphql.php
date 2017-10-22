<?php

namespace app\core\service;

use app\core\exception\GraphqlException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

/**
 * Description of Graphql
 *
 * @author Tobi
 */
class Graphql
{

    public function __construct()
    {
        ;
    }

    public function query($GQL)
    {
        try {
            $query_string = preg_replace("[\n,\r,' ']", '', $GQL);
            $client = new Client();
            $res = $client->request('GET', 'http://localhost:8080/graphql.php', [
                    'query' => ['query' => $query_string]
                ]
            );
            $response = $res->getBody();
            $json_decode = json_decode($response, true);
            if (isset($json_decode['errors'])) {
                throw new GraphqlException($json_decode['errors'][0]['message']);
            }
            return $response;
        } catch (ConnectException $exc) {
            echo $exc->getMessage();
            return '';
        }
    }

}
