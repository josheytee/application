<?php

namespace app\core\entity\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;

/**
 * Description of EntityController
 *
 * @author joshua
 */
abstract class EntityControllerBase extends ControllerBase {

//    abstract function title();

    function getDependencies(){}

    public function getModel(Request $request) {
        return $request->get('_model');
    }
}
