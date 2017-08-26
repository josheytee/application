<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\entity\controller;

use app\core\entity\controller\EntityControllerBase;
use app\core\view\form\Formbuilder;
use app\core\http\Request;

/**
 * Description of EntityFormController
 *
 * @author joshua
 */
abstract class EntityFormController extends EntityControllerBase {

    abstract public function build(Formbuilder $request, $entity);

    public function getEntity($entity_id) {
        $doctrine = $this->doctrine();
        $doctrine->find($this->model(), $entity_id);
    }

    public function create(Request $request, Formbuilder $builder) {
        if ($this->validate($request)) {
            $this->process($request);
            $return['content'] = $this->build($builder)->fetch();
            return $return;
        }
    }

}
