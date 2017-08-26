<?php

namespace app\core\entity\controller;

use app\core\controller\ControllerBase;

/**
 * Description of EntityController
 *
 * @author joshua
 */
abstract class EntityControllerBase extends ControllerBase {

    abstract function title();

    abstract function model();
}
