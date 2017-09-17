<?php

namespace app\core\service;

/**
 * Description of ResourceManagementService
 *
 * @author Tobi
 */
class ResourceManagementService extends KernelService {

    private $resiurce_list = [];

    public function __construct() {
        parent::__construct();
    }

    public function getResource($filename) {

    }

    public function useResource($resource_name) {
        $json = file_get_contents("app/resource/bootstrap/resource.json");
        $json_decode = json_decode($json);
        if (in_array($resource_name, $json_decode)) {
            var_dump(array_keys(get_object_vars($d->resource)));
        }
        var_dump($json_decode);
    }

}
